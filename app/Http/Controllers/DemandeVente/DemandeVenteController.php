<?php

namespace App\Http\Controllers\DemandeVente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;
use Storage;

class DemandeVenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*dd(User::asLetters("1003,66"));*/

     	$id = Auth::id();

        $actuel = User::FindOrFail($id);


        $produits = DB::select("select p.id,p.code_produit as nom,p.description from produits p where p.prestation = \"non\" order by code_produit");
        
        $prestations = DB::select("select p.id,p.code_produit as nom,p.description from produits p where p.prestation = \"yes\" order by code_produit");
    	
        $articles=DB::select("select * from articles order by nom");

        $type_pieces=DB::select("select * from type_pieces");

        $produits = User::ajuster_produits($produits);
        $articles = User::ajuster_articles($articles);
        $prestations = User::ajuster_prestations($prestations);
        
        $all = array_merge($produits,$prestations,$articles);
        
        $produits = $all;
        
        $produitss = $all;
    	
        $clients=DB::select("select * from client_prospects order by code_client");

    	$employes=DB::select("select * from employes order by nom");

        $produitss = json_encode($produitss);
    	
    	return view('Vente\DemandeVente',compact('prestations','employes','clients','articles','produits','produitss','type_pieces'));
    }

    public function AddDemandeVente(Request $request)
    {   

        $date_echue=(date('Y-m-d', strtotime(' +'.$request->valabilite.' month')));

        $id = Auth::id();
        
        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;

        $articles=DB::select("select * from articles");

        $clients=DB::select("select * from client_prospects");

        $employes=DB::select("select * from employes");

        $id_client=$request->input('client');

        $total=0;

        DB::insert("insert into pre_ventes (id_employe,id_client,date_echue,NB) values('$id','$id_client','$date_echue','$request->NB') ");

        $pre_vente=DB::select("select * from pre_ventes order by id  DESC limit 1");

        $id_preVente=$pre_vente[0]->id;
        
        $total=0;
        

        foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
        {

            $index = $key +1;
            $type=$array['type'];
            $id_article=$array['produit'];
            $quantite=$array['quantite_prod'];
            $prix=$array['prix_prod'];
            $tot=$quantite*$prix;

            if($type == "article")
            {
    
                DB::insert("insert into ligne_ventes (id_article,id_client,id_pre_vente,quantite,prix_u,total) 
                values('$id_article','$id_client','$id_preVente','$quantite','$prix','$tot') ;");

                //
            }
            else
            {

                DB::insert("insert into ligne_ventes (id_produit,id_client,id_pre_vente,quantite,prix_u,total) 
                values('$id_article','$id_client','$id_preVente','$quantite','$prix','$tot') ;");

                //
            }

            $total=$total+$prix*$quantite;

            # code...
        }

        DB::update(" update pre_ventes p set montant='$total' where p.id='$id_preVente' ");

        if ($request->existe_doc == "OUI") 
        {
   
            foreach ($request['dynamic_form2']['dynamic_form2'] as $key=>$array) 
            {
                
                $type_piece = ($array['type_doc']);
                
                $file1 = $array['document'];
                
                $file1->move('documents_preventes','Prevente_'.$id_preVente.'_'.time().'_'.$file1->getClientOriginalName());
                
                $chemin1 = "documents_preventes/".'Prevente_'.$id_preVente.'_'.time().'_'.$file1->getClientOriginalName();

                DB::insert("insert into pieces_preventes (id_prevente,id_piece,chemin_piece) 
                values ('$id_preVente','$type_piece','$chemin1') ");
            }        
   
            # code...
        }

        return back()->with('success','Demande N° '.$id_preVente.' Envoyée avec succée');
    }

    public function DemandeVenteAttente()
    {


        $id = Auth::id();

        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;

        $articles=DB::select("select * from articles ");

        $clients=DB::select("select * from client_prospects");

        $employes=DB::select("select * from employes");

        $ventes=DB::select(" select  *,p.id as preVente,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom,u.name as nom_employe, u.prenom as prenom_employe 
            
            from client_prospects c,pre_ventes p, categorie_clients ca , activite_clients ac,users u
            
            where p.id_client=c.id and c.id_categorie = ca.id and c.id_activite = ac.id and u.id=p.id_employe
            order by preVente desc");
        
        $ligne_ventes1=DB::select("select *,a.nom,a.description,l.quantite,l.total,(a.total-a.benifice) as PrixArticleAchat
            from ligne_ventes l, articles a 
            where (l.id_article=a.id)");
        
        $ligne_ventes2=DB::select("select *,a.code_produit as nom,a.description,l.quantite,l.total,l.prix_u as PrixArticleAchat
            from ligne_ventes l, produits a 
            where (l.id_produit=a.id)");
        
        foreach ($ligne_ventes2 as $value) 
        {
            $prix = (DB::select("select prix from stocks where id_produit = '$value->id_produit'"));    

            if (count($prix)>0) 
            {

                $value->PrixArticleAchat = $prix[0]->prix;       

                # code...
            }
            else
            {

                $value->PrixArticleAchat = "indispo";       
            }
            


            # code...
        }
        
        $ligne_ventes = array_merge($ligne_ventes1,$ligne_ventes2);

        $pieces = DB::select("select * from type_pieces tp, pieces_preventes pp where tp.id = pp.id_piece");
        
        return view('Vente\DemandeEnAttente',compact('pieces','employes','ventes','ligne_ventes','privilege'));
    }



    public function RefuserDemandeVente(Request $request,$idPreVente)
    {
            
        $id = Auth::id();

        $actuel = User::FindOrFail($id);        

        $commentaire=$request->input('commentaire_refus');
     
        DB::update("update pre_ventes p set statut_validation= 1, commentaire ='$commentaire', id_validateur='$id'  where p.id='$idPreVente' ");

        return back()->with('success','La demande :  de Vente '.$idPreVente.' a été refusé avec succé');
     }



    public function ValiderDemandeVente(Request $request,$idPreVente)
    {

        $id = Auth::id();

        $actuel = User::FindOrFail($id);

        DB::update("update pre_ventes p set statut_validation= 2, commentaire='$request->commentaire_accept',id_validateur='$id'  where p.id='$idPreVente'");

        /*DB::insert("insert into ventes")*/

        return back()->with('success','La demande :  de Vente '.$idPreVente.' a été Approuvée avec succé');
    }



    public function get_price(Request $request)
    {   

        if ($request->type != "article") 
        {
        
            $qte = DB::select("select * from stocks where id_produit = \"$request->id\" ");

            if(count($qte) > 0)
            {

                $qte = $qte[0];

                //
            }
            else
            {

                $qte = ["quantite" => 0 , "prix_vente"=>""];
                
                //
            }

            # code...
        }
        else
        {

            $prod_requis = (DB::select("select pvp.id_article,pvp.id_produit,pvp.quantite,a.total as prix_vente from articles a,prix_vente_produits pvp 
                where a.id=pvp.id_article and a.id = '$request->id' "));

            $u=0;

            foreach ($prod_requis as $prod) 
            {
            
                $qte = (DB::select("select quantite/'$prod->quantite' as qte from stocks where id_produit = '$prod->id_produit' "));

                if (count($qte)>0) 
                {

                    $quantities[$u] = (int)$qte[0]->qte;
                    
                    $u++;
                    
                    # code...
                }
                else
                {

                    $quantities[$u] = 0;
                    
                    $u++;

                    #..
                }

                # code...
            }

            $qte = ["quantite" => min($quantities) , "prix_vente"=>$prod_requis[0]->prix_vente];
            
            #...
        }
        

        return response()->json($qte);        

        # code...
    }    


    public function VenteFactureProformat(Request $request,$idPreVente)
    {

        $ventetest=DB::select("select * from pre_ventes where id='$idPreVente'");
        
        $ligne_ventes1=DB::select("select a.nom,a.description,l.prix_u,l.quantite,l.total 
            from ligne_ventes l, articles a 
            where (l.id_article=a.id and l.id_pre_vente = '$idPreVente' ) ");

        $ligne_ventes2=DB::select("select a.code_produit as nom,a.description,l.prix_u,l.quantite,l.total 
            from ligne_ventes l, produits a 
            where (l.id_produit=a.id and l.id_pre_vente = '$idPreVente' ) ");

        $ligne_ventes = array_merge($ligne_ventes1,$ligne_ventes2);
        
        $client = DB::select("select *,code_client as code from client_prospects where id = (select id_client from pre_ventes where id = '$idPreVente' ) ");
        
        $now = Carbon::now()->format('d/m/Y');

        $year = Carbon::now()->format('Y');        

        $NbNumFP=DB::select("select count(*) as number from  pre_ventes where statut_validation = 2 and num_facture_proformat like '%$year' ");

        $en_lettre = User::asLetters($ventetest[0]->montant*1.19);

        $NbNumFP=$NbNumFP[0]->number;

        $NbNumFP=$NbNumFP+1;

        $numfp= $NbNumFP."/".$year;

        if($ventetest[0]->num_facture_proformat == NULL)
        {
            //DB::update("update pre_ventes p set num_facture_proformat='$numfp' where p.id='$idPreVente'");
            
            DB::update("update pre_ventes p set date_edition_FP='$now' where p.id='$idPreVente'");

            $dompdf = new Dompdf();

            $les_produits = '';
            $k = 1;



            foreach ($ligne_ventes as $ligne) 
            {
    
                $les_produits = $les_produits .
                '<tr class="item">
                    
                    <td class="td" style="text-align: center;" >
                        '.$k.'
                    </td>
                    <td class="td" style="text-align: center;" >
                        '.$ligne->nom.'
                    </td>                    
                    <td class="td" style="text-align: center;" >
                        '.$ligne->description.'
                    </td>
                    <td class="td" style="text-align: center;" >
                        '.$ligne->quantite.'
                    </td>
                    <td class="td" style="text-align: center;" >
                        '.number_format($ligne->prix_u).'
                    </td>
                    <td class="td" style="text-align: center;" >
                        '.number_format($ligne->total).'
                    </td>
                </tr>';

                $k++;
                # code...
            }
            
            if ($client[0]->taux_remise_spec != 0) 
            {
            
                $total =  '<table border="1" style="float: right; width: 34%;" >
            
                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant).' </td>
                    </tr>

                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Remise </b> </td>
                        <td align="center"> '. number_format(($ventetest[0]->montant)*($client[0]->taux_remise_spec/100)) .' </td>
                    </tr>

                    <tr>
                        
                        <td align="left" style="width: 45%;"><b>Montant aprés Remise   </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant*(1-($client[0]->taux_remise_spec/100))).' </td>
                    </tr>            
                    
                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant*0.19).' </td>
                    </tr>

                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant*1.19).' </td>
                    </tr>
            
                </table>';

                # code...
            }
            else
            {

                $total =  '<table border="1" style="float: right; width: 34%;" >
            
                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant).' </td>
                    </tr>
                    
                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant*0.19).' </td>
                    </tr>

                    <tr>
                        
                        <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                        <td align="center"> '.number_format($ventetest[0]->montant*1.19).' </td>
                    </tr>
            
                </table>';

                #..
            }




            
            $html = '<!doctype html>

            <html lang="en">

                <head>

                    <meta charset="UTF-8">
                    
                    <title>Facture Pro format </title>

                    <style type="text/css">
                    *{
                        font-family: Verdana, Arial, sans-serif;
                    }

                    .les_prod, .th, .td 
                    {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    
                    </style>
                </head>

                <body style="font-size : 12px;" > 
                    
                    <table id="tabla" width="100%">
                        <tr>
                            <td>
                                
                                <img src="'.public_path("algematic.png").'">
                                
                                <h4 style="text-align: left;">Facture Pro Format N° : '.$numfp.' <span style="float:right; margin-right:4%;"> Alger, le 29/08/2020 </span></h4>
                                
                                <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: right;" > 
                                    
                                    <b>Client: </b> 001 <br> 
                                    <b>Adresse :</b> Adresse: '.$client[0]->adresse.' <br>  
                                    <b>RC :</b> '.$client[0]->RC.' <br>  
                                    <b>NIF :</b> '.$client[0]->RC.' <br>  
                                    <b>AI :</b> '.$client[0]->n_art_imp.' <br>  
                                </div>

                                <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: left;" >   
                                    <b>Raison :</b>  SARL ALGEMARTIC <br>
                                    <b>Adresse :</b> Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger. 16120<br>  
                                    <b>RC :</b> 16/00-0984669 B 12 <br>  
                                    <b>AI :</b> 16390745693 <br>  
                                    <b>NIF :</b> 00 1216098466902 <br>  

                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <br/><br/><br/><br/><br/><br/><br/><br/> Relatif au bon de commande N°'.$ventetest[0]->num_bc.' <br/><br/>
                    
                    <table class="les_prod" width="100%" >
                    
                        <thead>
                            <tr>
                                <th class="th" >N°</th>
                                <th class="th" >Référance</th>
                                <th class="th" >Désignation</th>
                                <th class="th" >Quantité</th>
                                <th class="th" >Prix U.HT</th>
                                <th class="th" >Montant HT</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            '.$les_produits.'
                        </tbody>

                    </table>

                    '.$total.'

                    <br><br><br><br><br><br><br><br>

                    <div style="margin-left: 3%;">

                        <h5 >Arrête le présent Bon de Commande à la somme de : </h5>
                        <h5 >'.$en_lettre.' Dinars </h5>
                        
                        <h5 >NB : </h5>
                        <h5 >Valabitité de l\'offre '.$ventetest[0]->valabilite.' mois </h5>
                        <h5 > '.nl2br($ventetest[0]->NB).' </h5>
                    </div>
                    
                    <div style="margin-left: 3%;">
                        
                        <h5 style="float: right; margin-right: 10%;">P/SARL ALGEMARTIC Cachet et signature</h5>
                        <h5 style="float: left;" >Approbation de la commande par le client</h5>
                    </div>
                    
                    <br><br><br>
                    
                    <hr style="border: solid 2px;">

                    <h5><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
                    <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>
                </body>
            </html>';

            $dompdf->loadHtml($html);
            $dompdf->render();
            $content = $dompdf->output();
            $file = $content;
            Storage::put('Proforma/file_'.'FP'.$NbNumFP.'_'.$year.'.pdf',$file);
            $dompdf->stream('FP'.$NbNumFP.'_'.$year.'.pdf', array('Attachment'=>0));


        } 
    }

}
