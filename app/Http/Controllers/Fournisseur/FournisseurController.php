<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;

class FournisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$fournisseurs=DB::select("select * from fournisseurs where visible=1");
        $produits=DB::select("select p.id,p.code_produit,p.description,p.photo,p.model,p.id_unite,u.description as UniteDescription,p.id_fabricant,f.nom as NomFabricant,p.id_sous_famille,s.nom as NomFamille
             from produits p,unites u, fabricants f,sous_familles s 
            where p.id_unite=u.id and p.id_sous_famille=s.id and p.id_fabricant=f.id and p.visible=1");


    	
    	return view('Fabricant\fournisseur',compact('fournisseurs','produits'));
     }

      public function AddFournisseur(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'adresse' => 'required|max:800',
            'activite' => 'required|max:500',
            'tele' => 'required|regex:/(0)[0-9]{9}/',
            'fax' => 'required|regex:/(0)[0-9]{8}/',
            'mobile' => 'required|regex:/(0)[0-9]{8}/',
            'email' => 'required|email',
            'nif' => 'required|regex:/[0-9]{10}/',
            'nis' => 'required|regex:/[0-9]{10}/',
            'rc' => 'required|max:30',
            'num_art_imp' => 'required|max:30',
            ]);

    	
    	$tele=$request->input('tele');
        $info=DB::select("select * from fournisseurs where tele='$tele'");
       
        

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Cet Fournisseur  existe déja  !!! ');

                return redirect()->back(); 
               }
		else
			   {
					$fournisseur_nom=$request->input('nom');
					$fournisseur_adresse=$request->input('adresse');
					$fournisseur_activite=$request->input('activite');
					$fournisseur_tele=$request->input('tele');
					$fournisseur_fax=$request->input('fax');
					$fournisseur_mobile=$request->input('mobile');
					$fournisseur_email=$request->input('email');
					$fournisseur_nif=$request->input('nif');
					$fournisseur_nis=$request->input('nis');
					$fournisseur_rc=$request->input('rc');
					$fournisseur_num_art_imp=$request->input('num_art_imp');
			        
			        //$depot->save();

			        DB::insert("insert into fournisseurs (nom,adresse,activite,tele,fax,mobile,email,nif,nis,rc,num_art_imp) values('$fournisseur_nom','$fournisseur_adresse','$fournisseur_activite','$fournisseur_tele','$fournisseur_fax','$fournisseur_mobile','$fournisseur_email','$fournisseur_nif','$fournisseur_nis','$fournisseur_rc','$fournisseur_num_art_imp') ");
			        
			        
			        return redirect('/fournisseur')->with('success','Le Fournisseur est enregistré avec succée');

				}
       
    }


 public function ModifFournisseur(Request $request,$idFournisseurModif)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'adresse' => 'required|max:800',
            'activite' => 'required|max:500',
            'tele' => 'required|regex:/(0)[0-9]{9}/',
            'fax' => 'required|regex:/(0)[0-9]{8}/',
            'mobile' => 'required|regex:/(0)[0-9]{8}/',
            'email' => 'required|email',
            'nif' => 'required|regex:/[0-9]{10}/',
            'nis' => 'required|regex:/[0-9]{10}/',
            'rc' => 'required|max:30',
            'num_art_imp' => 'required|max:30',
            ]);

    	
    	$tele=$request->input('tele');
        $info=DB::select("select tele from fournisseurs where tele='$tele'");
       
        

         if (count($info)>1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce téléphone existe déja  !!! ');

                return redirect()->back(); 
               }
		else
			   {
					$fournisseur_nom=$request->input('nom');
					$fournisseur_adresse=$request->input('adresse');
					$fournisseur_activite=$request->input('activite');
					$fournisseur_tele=$request->input('tele');
					$fournisseur_fax=$request->input('fax');
					$fournisseur_mobile=$request->input('mobile');
					$fournisseur_email=$request->input('email');
					$fournisseur_nif=$request->input('nif');
					$fournisseur_nis=$request->input('nis');
					$fournisseur_rc=$request->input('rc');
					$fournisseur_num_art_imp=$request->input('num_art_imp');
			        
			        DB::update("update fournisseurs f set nom='$fournisseur_nom',adresse='$fournisseur_adresse',activite='$fournisseur_activite',tele='$fournisseur_tele',fax='$fournisseur_fax',mobile='$fournisseur_mobile',email='$fournisseur_email',nif='$fournisseur_nif',nis='$fournisseur_nis',rc='$fournisseur_rc',num_art_imp='$fournisseur_num_art_imp' where f.id='$idFournisseurModif'  ");

			        
			        
			        return redirect('/fournisseur')->with('success','Le Fournisseur a été Modifié avec succée');

				}
       
    }

    public function SupprimerFournisseur(Request $request,$idFournisseurSupprimer)
    {
        
        DB::update("update  fournisseurs set visible=0  where id='$idFournisseurSupprimer'");
        return redirect('/fournisseur')->with('success','Le Fournisseur a été supprimé avec succée');

    }

   /* public function AddBC(Request $request,$idFournisseur,$nomFournisseur)
    {
        //dd($request->all());

        $produits = $request->all();
        $produit = $produits['produit'];
        $produits['produit'] = implode(',', $produit);
        $produits=$produits["produit"];
        $produits=explode(",", $produits);

        return view('Fabricant\BC',compact('produits','idFournisseur','nomFournisseur'));
    }

     public function PDF(Request $request,$idFournisseur,$nomFournisseur)
    {

        $numfacture=$request->input('facture');
        $photo=$request->input('photo');

        $nbproduit=count($request->all());

        $i=0;
        
        foreach ($request->all() as $valeur) {
            
            if ($i!=1 && $i!=0 && $i!=2) 
            {
                dd($valeur);
            }

            $i++;
        }

        
        return view('Fabricant\BCShow',compact('produits','idFournisseur','nomFournisseur','numfacture'));
    }
*/


    public function commande(Request $request,$idFournisseur)
    {
               

                $this->validate($request,[
                'facture' => 'required|max:300',
                'remise' => 'required|max:20',
                'tva' => 'required|max:20',
                
                ]);

        
        $facture=$request->input('facture');
        $info=DB::select("select id from pre_achat where num_facture_proformat='$facture'");
       
        

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce N° de Facture Pro Forma  existe déja  !!! ');

                return redirect()->back(); 
               }
        else
               {    

                    $file_extension= $request->photo->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/factureproforma';
                    $request->photo->move($path,$file_name);

                    $achat_facture=$request->input('facture');
                    $achat_date=$request->input('date');
                    $achat_remise=$request->input('remise');
                    $achat_tva=$request->input('tva');
                    $achat_photo=$file_name;
                    $year = Carbon::now()->format('Y');

                 DB::insert("insert into pre_achat (id_fournisseur,date_achat,num_facture_proformat,facture_proformat_photo,annee_bc,remise,tva) values('$idFournisseur','$achat_date','$achat_facture','$achat_photo','$year','$achat_remise','$achat_tva') ");

                $fournisseurs=DB::select("select * from fournisseurs where visible=1 and id='$idFournisseur'");
                $produits=DB::select("select p.id,p.code_produit,p.description,p.photo,p.model,p.id_unite,u.description as UniteDescription,p.id_fabricant,f.nom as NomFabricant,p.id_sous_famille,s.nom as NomFamille from produits p,unites u, fabricants f,sous_familles s 
                        where p.id_unite=u.id and p.id_sous_famille=s.id and p.id_fabricant=f.id and p.visible=1");

                return view('Fabricant\commandeOmar',compact('produits','fournisseurs','achat_facture'));

              }
    }




    public function ADDcommande(Request $request,$idFournisseur,$numfactureproformat)
    {
        //dd($request->all());
         $fournisseurs=DB::select("select * from fournisseurs where  id='$idFournisseur'");
         $pre_achat=DB::select("select * from pre_achat where  num_facture_proformat='$numfactureproformat'");

         

         $now = Carbon::now()->format('d/m/Y');

 

         $year = Carbon::now()->format('Y');



         $pre=DB::select("select count(*) as number from pre_achat where annee_bc='$year' and id not in (select id from pre_achat where num_facture_proformat='$numfactureproformat')");
         

         $nbNumBCExistant= $pre[0]->number;

         $nbNumBCExistant= $nbNumBCExistant+1;

         $NewNumBC= $nbNumBCExistant."/".$year;
         
         DB::update("update pre_achat f set num_bc='$NewNumBC' where f.num_facture_proformat='$numfactureproformat'  ");

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
                  <h2 style="text-align: center;">BON DE COMMANDE</h2>
                  <h3 style="text-align: center;">N°: '.$NewNumBC.'   - Date: '.$now.' </h3>
                  <hr>
                  <h3 style="text-align: center;"> IDENTIFICATION DU SERVICE CONTRACTANT </h3>
                  <hr>
                  <h4 style="text-align: center;>Dénomination: SARL ALGEMATIC</h4>
                  <h4>Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.</h4>
                  <hr>
                  <h3 style="text-align: center;"> IDENTIFICATION DU PRESTATAIRE </h3>
                  <hr>
                    <h4 style="text-align: center;>'.$fournisseurs[0]->nom.' </h4>
                    <h4 style="text-align: center;>Relatif à la Facture Pro Format N° '.$numfactureproformat.' du '.$pre_achat[0]->date_achat.' </h4>
                    <hr>

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
                <th>N</th>
                <th>Article</th>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix U.HT</th>
                <th>Montant HT</th>
              </tr>
            </thead>
            <tbody>';
            $total = 0;
            $i=0;
            foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
            {
                    $index = $key +1;

                    $code_produit=$array['produit'];
                    $id_produit=DB::select("select id  from produits where code_produit='$code_produit'");
                    $id_prod=$id_produit[0]->id;
                    $id_pre_achat=$pre_achat[0]->id;
                    $quanitite=$array['quantite'];
                    $prix=$array['prix'];
                    $designation=DB::select("select description from produits where  code_produit='$code_produit'");

                    $trouve=DB::select("select * from ligne_produit l
                        where l.id_pre_achat='$id_pre_achat' and l.id_produit='$id_prod' ");
                    if(count($trouve) == 0)
                    {
                         DB::insert("insert into ligne_produit (id_pre_achat,id_produit,date_demande,qte_demande,prix) 
                        values('$id_pre_achat','$id_prod','$now','$quanitite','$prix') ;");
                    }

                        
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    <td>
                        '.$array['produit'].'
                    </td>
                    <td>

                        '.$designation[0]->description.'
                    </td>
                    <td align="right">
                        '.$array['quantite'].'
                    </td>
                    <td align="right">
                    '.$array['prix'].'
                    </td>
                    <td align="right">
                    '.$array['prix']*$array['quantite'].'
                    </td>
                </tr>';

                $total=$total+$array['prix']*$array['quantite'];
                            }

            $prix_remise=$total*$pre_achat[0]->remise/100;
            $total_HT=$total-$prix_remise;
            $montant_tva=$total_HT*$pre_achat[0]->tva/100;
            $total_TTC=$montant_tva+$total_HT;

        $html.='
            </tbody>
            <tfoot>';
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total HT </td>
                    <td align="right">'.$total.'</td>
                </tr>
                 <tr>
                    <td colspan="4"></td>
                    <td align="right">Remise '.$pre_achat[0]->remise.' %</td>
                    <td align="right">'.$prix_remise.'</td>
                </tr>
                 <tr>
                    <td colspan="4"></td>
                    <td align="right">Net HT</td>
                    <td align="right">'.$total_HT.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Montant TVA '.$pre_achat[0]->tva.' %</td>
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
        $dompdf->stream("d_facture", array('Attachment'=>1));



            //dd($request['dynamic_form']['dynamic_form'][0]['produit']);
            //foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            // $produit_json = json_decode($array['produit'], true);
            // $produit  = Produit::find($produit_json['id']);
            // $qteOld = $produit->quantite;
            // $qteNew = $qteOld - $array['quantite'];  
            // $produit->quantite = $qteNew;
            // $produit->save();
            // $total_produit = $array['quantite']*$array['prix'];
            // $total = $total + $total_produit;
            // $produit_json['quantite'] = $array['quantite'];
            // $produit_json['prix_vente'] = $array['prix'];
            // array_push($produits,$produit_json);
            // $stock = new  Stock();
            // $stock->produit = $array['produit'];
            // $stock->quantite = $array['quantite'];
            // $stock->operation = 'sortie';
            // $stock->save();
        


        //}
    }
}
