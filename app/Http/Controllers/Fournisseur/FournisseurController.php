<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;

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

			        DB::insert("insert into fournisseurs (nom,adresse,activite,tele,fax,mobile,email,nif,nis,rc,num_art_imp) values('$$fournisseur_nom','$fournisseur_adresse','$fournisseur_activite','$fournisseur_tele','$fournisseur_fax','$fournisseur_mobile','$fournisseur_email','$fournisseur_nif','$fournisseur_nis','$fournisseur_rc','$fournisseur_num_art_imp') ");
			        
			        
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

    public function AddBC(Request $request,$idFournisseur,$nomFournisseur)
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

    public function commande($idFournisseur)
    {
                $fournisseurs=DB::select("select * from fournisseurs where visible=1 and id='$idFournisseur'");
                $produits=DB::select("select p.id,p.code_produit,p.description,p.photo,p.model,p.id_unite,u.description as UniteDescription,p.id_fabricant,f.nom as NomFabricant,p.id_sous_famille,s.nom as NomFamille from produits p,unites u, fabricants f,sous_familles s 
                        where p.id_unite=u.id and p.id_sous_famille=s.id and p.id_fabricant=f.id and p.visible=1");
                return view('Fabricant\commandeOmar',compact('produits','fournisseurs'));

    }

    public function ADDcommande(Request $request,$idFournisseur)
    {
        //dd($request->all());
                        $fournisseurs=DB::select("select * from fournisseurs where visible=1 and id='$idFournisseur'");

        $dompdf = new Dompdf();
        //$options = $dompdf->getOptions(); 
        //$options->set(array('isRemoteEnabled' => true));
        //$dompdf->setOptions($options);

        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
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
                  <h1>BON DE COMMANDE</h3>
                    <h3>'.$fournisseurs[0]->nom.' <br>Tél:0661944781-0561709265</h3>
                        Fax:035740082 <br>
                        bibanfretcompany@gmail.com<br>
                        Capital Social :2 000 000 DA<br>
                        Auxiliare de transport Routier<br>
                        Agrément n* 50/2017 du Ministre de transport <br>   
                </td>
                <td align="right">
                    <img src=""  />
                </td>
            </tr>
          </table>
          <table width="100%">
            <tr>
            <td><strong>Numero:</strong> test</td>
            <td align="right">
                    B.B.A Le:   
                    <br>test <br>Raison Sociale : test<br>Adress:test
                    <br>
                    Registre de commerce :test<br>
                    Identifiant Fiscale:test<br>
                    NIS:test<br>
                    AI :test
                </td>
            </tr>
          </table>
          <br/>
          <table width="100%">
            <thead style="background-color: lightgray;">
              <tr>
                <th>N</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix HT</th>
              </tr>
            </thead>
            <tbody>';
            $total = 0;
            foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) {
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    <td>
                        '.$array['produit'].'
                    </td>
                    <td align="right">
                        '.$array['quantite'].'
                    </td>
                    <td align="right">
                    '.$array['prix'].'
                    </td>
                </tr>';
            }
        $html.='
            </tbody>
            <tfoot>';
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total HT </td>
                    <td align="right">800</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">TVA 19% </td>
                    <td align="right">900</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total </td>
                    <td align="right">1859.00</td>
                </tr>';
            
            $html.='</tfoot>
          </table>
        </body>
        </html>';



        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("d_facture", array('Attachment'=>0));



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
