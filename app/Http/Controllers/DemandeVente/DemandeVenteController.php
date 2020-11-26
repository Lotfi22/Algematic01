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

    	$articles=DB::select("select * from articles order by nom");

        $produits = DB::select("select p.id,p.code_produit,p.description from produits p order by code_produit");
        

        $produitss = DB::select("select p.id,p.code_produit,p.description from produits p order by code_produit");
    	
        $clients=DB::select("select * from client_prospects order by code_client");

    	$employes=DB::select("select * from employes order by nom");

        $produitss = json_encode($produitss);
    	
    	return view('Vente\DemandeVente',compact('employes','clients','articles','produits','produitss'));
    }

    public function AddDemandeVente(Request $request)
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;



        $articles=DB::select("select * from articles ");

        $clients=DB::select("select * from client_prospects");

        $employes=DB::select("select * from employes");

        $client=$request->input('client');

        $client=DB::select("select *  from client_prospects where id='$client'");

        $id_client=$client[0]->id;

        $total=0;

        DB::insert("insert into pre_ventes (id_validateur,id_client) 
                        values('$id','$id_client') ");

        $pre_vente=DB::select("select * from pre_ventes order by id  DESC limit 1");

        $id_preVente=$pre_vente[0]->id;

        $total=0;

        foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
        {
            $index = $key +1;
            $id_article=$array['produit'];
            $quantite=$array['quantite'];
            $prix=$array['prix'];
            $tot=$quantite*$prix;

            DB::insert("insert into ligne_ventes (id_article,id_client,id_pre_vente,quantite,prix_u,total) 
            values('$id_article','$id_client','$id_preVente','$quantite','$prix','$tot') ;");
              

                    
            $total=$total+$array['prix']*$array['quantite'];
        }

        DB::update(" update pre_ventes p set montant='$total' where p.id='$id_preVente' ");

        return redirect('/DemandeVente')->with('success','Demande Envoyée avec succée');
    }

    public function DemandeVenteAttente()
    {


        $id = Auth::id();

        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;

        $articles=DB::select("select * from articles ");

        $clients=DB::select("select * from client_prospects");

        $employes=DB::select("select * from employes");

        $ventes=DB::select(" select  *,p.id as preVente,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom from client_prospects c,pre_ventes p, categorie_clients ca , activite_clients ac
            where p.id_client=c.id and c.id_categorie = ca.id and c.id_activite = ac.id
            order by p.id DESC");



        $ligne_ventes=DB::select("select *,a.nom,a.description,l.total,a.total as PrixArticleAchat from ligne_ventes l, articles a where l.id_article=a.id");

         
        return view('Vente\DemandeEnAttente',compact('employes','ventes','ligne_ventes','privilege'));
    }



    public function RefuserDemandeVente(Request $request,$idPreVente)
    {

        $commentaire=$request->input('commentaire');

        DB::update("update pre_ventes p set statut_validation= 1, commentaire ='$commentaire' where p.id='$idPreVente' ");

        return back()->with('success','La demande de Vente a été refusé avec succé');
     }



    public function ValiderDemandeVente(Request $request,$idPreVente)
    {
       
        DB::update("update pre_ventes p set statut_validation= 2 where p.id='$idPreVente' ");

        return back()->with('success','La demande de Vente a été Validé avec succé');
    }



    public function get_price(Request $request)
    {
        
        $qte = DB::select("select quantite,prix from stocks where id_produit = \"$request->id\" ");

        if(count($qte) > 0)
        {

            $qte = $qte[0];

            //
        }
        else
        {

            $qte = ["quantite" => 0 , "prix"=>""];
            
            //
        }

        return response()->json($qte);        

        # code...
    }    


    public function VenteFactureProformat(Request $request,$idPreVente)
    {
         
        $ventes=DB::select(" select  *,p.id as preVente,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom from client_prospects c,pre_ventes p, categorie_clients ca , activite_clients ac
             where p.id_client=c.id and c.id_categorie = ca.id and c.id_activite = ac.id and p.id='$idPreVente'");



        $ligne_ventes=DB::select("select *,a.nom,a.description,l.total from ligne_ventes l, articles a where l.id_article=a.id and l.id_pre_vente='$idPreVente' ");



        

        $now = Carbon::now()->format('d/m/Y');

        $year = Carbon::now()->format('Y');

        

        $NbNumFP=DB::select("select count(*) as number from  pre_ventes where num_facture_proformat like '%$year' ");


        $NbNumFP=$NbNumFP[0]->number;

        

        $NbNumFP=$NbNumFP+1;
        

        $numfp= $NbNumFP."/".$year;

        $ventetest=DB::select("select * from pre_ventes where id='$idPreVente'");

        if($ventetest[0]->num_facture_proformat == NULL)
        {
            DB::update("update pre_ventes p set num_facture_proformat='$numfp' where p.id='$idPreVente'");
            
            DB::update("update pre_ventes p set date_edition_FP='$now' where p.id='$idPreVente'");

            $dompdf = new Dompdf();

            $html = '<!doctype html>

            <html lang="en">

            <head>

                <meta charset="UTF-8">

                <title>Bon de Commande </title>

                <style type="text/css">
                    * {
                        font-family: Verdana, Arial, sans-serif;
                    }
                    table{
                    }
                    tfoot tr td{
                        font-weight: bold;
                    }
                    .gray {
                        background-color: lightgray;
                    }
                    tbody {
                        width: 100%;
                    }
                </style>
            </head>

            <body> 
                <table width="100%">
                    <tr>
                        
                        <td valign="top"></td>
                        
                        <td align="left">
                        
                        <h1><B> ALGEMATIC</B></h1>
                        
                        <h2 style="text-align: center;">Facture Pro Format N° '.$numfp.'   ---   Alger, le '.$now.'  </h2>
                        
                        <div style="border: solid;" >  Raison: SARL ALGEMATIC <br> Adresse: Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.  </div>

                        <div style="border: solid;" >  Client: '.$ventes[0]->code_client.'  </div>
                     
                     
                    </td>
                    <td align="right">
                        <img src=""  />
                    </td>
                </tr>
              </table>
              
              <br/>
              <table width="100%">
                <thead style="background-color: lightgray;">
                  <tr>
                    <th>Référance</th>
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>Prix U.HT</th>
                    <th>Montant HT</th>
                  </tr>
                </thead>
                <tbody>';

            $total = 0;

            $i=0;

            foreach ($ligne_ventes as $ligne) 
            {
                    

                    $ref=$ligne->nom;
               
                    $description=$ligne->description;

                    $quantite=$ligne->quantite;

                    $prix=$ligne->prix_u;

                    $totale=$ligne->total;

                    

                        
                    $html.='<tr class="item">
                    
                    <td>
                        '.$ref.'
                    </td>
                    <td>

                        '.$description.'
                    </td>
                    <td align="right">
                        '.$quantite.'
                    </td>
                    <td align="right">
                    '.$prix.'
                    </td>
                    <td align="right">
                    '.$totale.'
                    </td>
                </tr>';

                $total=$total+$totale;
            }

            

            
            $total_HT=$total;
            $montant_tva=$total_HT*19/100;
            $total_TTC=$montant_tva+$total_HT;

        $html.='
            </tbody>
            <tfoot>';
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Montant Total HT </td>
                    <td align="right">'.$total_HT.'</td>
                </tr>
                
                
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Montant TVA 19% </td>
                    <td align="right">'.$montant_tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total TTC</td>
                    <td align="right">'.$total_TTC.'</td>
                </tr>';
            
            $html.='</tfoot>
          </table>
          <h5>Arrête le présent Bon de Commande à la somme de:</h5>
          <br>
          <h5 style="text-align: right;">Cachet et signature</h5>
          <br>
          <hr>
          <h5><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
          <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>

        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("FP'.$NbNumFP.'_'$year'", array('Attachment'=>0));

        } 

        else
        {
             
        
       



        $dompdf = new Dompdf();

        $html = '<!doctype html>
        <html lang="en">
    
            <head>
        
                <meta charset="UTF-8">
                <title>Bon de Commande </title>
                <style type="text/css">
                    * {
                        font-family: Verdana, Arial, sans-serif;
                    }
                    table{
                    }
                    tfoot tr td{
                        font-weight: bold;
                    }
                    .gray {
                        background-color: lightgray;
                    }
                    tbody {
                        width: 100%;
                    }
                </style>
            </head>
        
            <body> 
                <table width="100%">
                    <tr>
                        <td valign="top"></td>

                        <td align="left">
                            
                            <h1><B> ALGEMATIC</B></h1>
                            
                            <h2 style="text-align: center;">Facture Pro Format N° '.$ventetest[0]->num_facture_proformat.'   ---   Alger, le '.$ventetest[0]->date_edition_FP.'  </h2>
                            
                            <div style="border: solid;" >  Raison: SARL ALGEMATIC <br> Adresse: Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.  
                            </div>

                            <div style="border: solid;" >  Client: '.$ventes[0]->code_client.'  </div>
                        </td>
                        
                        <td align="right">
                            <img src=""  />
                        </td>
                    </tr>
                </table>
              
                <br/>
                
                <table width="100%">
                
                <thead style="background-color: lightgray;">
                    <tr>
                        <th>Référance</th>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Prix U.HT</th>
                        <th>Montant HT</th>
                    </tr>
                </thead>
            <tbody>';

                $total = 0;

                $i=0;

                foreach ($ligne_ventes as $ligne) 
                {
                        

                        $ref=$ligne->nom;
                   
                        $description=$ligne->description;

                        $quantite=$ligne->quantite;

                        $prix=$ligne->prix_u;

                        $totale=$ligne->total;

                        

                            
                        $html.='<tr class="item">
                        
                        <td>
                            '.$ref.'
                        </td>
                        <td>

                            '.$description.'
                        </td>
                        <td align="right">
                            '.$quantite.'
                        </td>
                        <td align="right">
                        '.$prix.'
                        </td>
                        <td align="right">
                        '.$totale.'
                        </td>
                    </tr>';

                    $total=$total+$totale;
                }
     
                $total_HT=$total;
                $montant_tva=$total_HT*19/100;
                $total_TTC=$montant_tva+$total_HT;

                $html.='
                
                </tbody>
            <tfoot>';
            
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Montant Total HT </td>
                    <td align="right">'.$total_HT.'</td>
                </tr>
                
                
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Montant TVA 19% </td>
                    <td align="right">'.$montant_tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total TTC</td>
                    <td align="right">'.$total_TTC.'</td>
                </tr>';
            
            $html.='</tfoot>
            </table>
            <h5>Arrête le présent Bon de Commande à la somme de:</h5>
            <br>
            <h5 style="text-align: right;">Cachet et signature</h5>
            <br>
            <hr>
            <h5><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
            <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>

            </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("FP'.$NbNumFP.'_'$year'", array('Attachment'=>0));

        } 
    }

}
