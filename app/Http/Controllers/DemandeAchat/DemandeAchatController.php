<?php

namespace App\Http\Controllers\DemandeAchat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;

class DemandeAchatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

     	$id = Auth::id();
        $actuel = User::FindOrFail($id);

        

    	$produits=DB::select("select * from produits");
    	$fournisseurs=DB::select("select * from fournisseurs");
        

    	
    	return view('Achat\DemandeAchat',compact('produits','fournisseurs'));
     }



    public function ADDDemandeAchat(Request $request)
     {

        $facture=$request->input('facture');
        $info=DB::select("select id from pre_achat where num_facture_proformat='$facture'");
       
        $testremise=$request->RemiseYN;



         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce N° de Facture Pro Forma  existe déja  !!! ');

                return redirect()->back(); 
               }
        else
               {    

              $file_extension= $request->photo->getClientOriginalExtension();
              $file_name=time().'.'.$file_extension;
              $path='images/DemandeAchat';
              $request->photo->move($path,$file_name);

              $facture=$request->input('facture');
              $date=$request->input('date');
              $photo=$file_name;
              $fournisseur=$request->input('fournisseur');


               $now = Carbon::now()->format('d/m/Y');

                if($testremise == 'yes')
              {
                
               
                $remise=$request->input('remise');

                DB::insert("insert into pre_achat (id_fournisseur,date_achat,num_facture_proformat,facture_proformat_photo,remise) 
                values('$fournisseur','$date','$facture','$photo','$remise') ");
              }

              else
              {
                
                DB::insert("insert into pre_achat (id_fournisseur,date_achat,num_facture_proformat,facture_proformat_photo,remiseradio) 
                values('$fournisseur','$date','$facture','$photo','$testremise') ");
              }

     			    $pre_achat=DB::select("select * from pre_achat where  num_facture_proformat='$facture'");

     			    $id_pre_achat=$pre_achat[0]->id;

     			    $total=0;

     	foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
            {
                    $index = $key +1;
                    $code_produit=$array['produit'];
                    $id_produit=DB::select("select id  from produits where code_produit='$code_produit'");
                    $id_prod=$id_produit[0]->id;
                    
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

                        
                $total=$total+$array['prix']*$array['quantite'];
            }

            DB::update("update pre_achat f set montant='$total' where f.num_facture_proformat='$facture'  ");



        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        return back();

	     }
	 }



	 public function DemandeAttente()
	 {

        

    	$presachats=DB::select("select * from pre_achat ");

    	$nature_doc_payments=DB::select("select * from nature_doc_payment");

    	$produits=DB::select("select * from stocks  ");

        $produits2=DB::select("select l.id_pre_achat,d.code_produit,l.id_produit,l.qte_demande,l.prix as nv_prix
            from  ligne_produit l, produits d
            where l.id_produit=d.id  ");


    	$nvproduits=DB::select("select l.id_produit,l.id_pre_achat,p.code_produit,p.description
    		from ligne_produit l, produits p where l.id_produit=p.id");

    	$employes=DB::select("select * from employes ");
    	
    	$etageres=DB::select("select * from etageres where id not in ( select id_etagere from arrivages) ");

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;

    	
    	return view('Achat\AchatAttente',compact('presachats','nature_doc_payments','privilege','produits','employes','etageres','nvproduits','produits2'));

	 }

	 public function RefuserDemande(Request $request,$idpreachat)
	 {

      $commentaire=$request->commentaire;
      DB::update(" update pre_achat p set p.commentaire='commentaire' where p.id='$idpreachat' ");
      DB::update(" update pre_achat p set p.refuser='1' where p.id='$idpreachat' ");
   

        return redirect('/home/achats/DemandeAttente')->with('success','La demande a été refusé avec succé');

	 }




	  public function ValiderPreAchat(Request $request,$idpreachat,$numfactureproformat)
	 {

        $test=DB::select("select * from pre_achat where id='$idpreachat' ");

        if($test[0]->demande_valide == 0)
        {



		$year = Carbon::now()->format('Y');

	    $pre=DB::select("select count(*) as number from pre_achat where annee_bc='$year' and id not in (select id from pre_achat where num_facture_proformat='$numfactureproformat')");


	     $nbNumBCExistant= $pre[0]->number;

	     $nbNumBCExistant= $nbNumBCExistant+1;

	     $NewNumBC= $nbNumBCExistant."/".$year;

	     $now = Carbon::now()->format('d/m/Y');

	     DB::update("update pre_achat f set num_bc='$NewNumBC' where f.num_facture_proformat='$numfactureproformat'  ");
	     DB::update("update pre_achat f set annee_bc='$year' where f.num_facture_proformat='$numfactureproformat'  ");
	     DB::update("update pre_achat f set demande_valide=1 where f.num_facture_proformat='$numfactureproformat'  ");

	     $produits=DB::select("select  p.id,p.code_produit,l.prix,l.qte_demande,l.id_pre_achat
	      from ligne_produit l, produits p 
	      where p.id=l.id_produit and l.id_pre_achat='$idpreachat' ");

	     $id_fournisseur=DB::select("select id_fournisseur from pre_achat where id='$idpreachat' ");

	     $id_fournisseur=$id_fournisseur[0]->id_fournisseur;
    	
	     $fournisseurs=DB::select("select * from fournisseurs where  id='$id_fournisseur'");

	     $pre_achat=DB::select("select * from pre_achat where  id='$idpreachat'");

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
                    <h4 style="text-align: center;>Relatif à la Facture Pro Format N° '.$pre_achat[0]->num_facture_proformat.' du '.$pre_achat[0]->date_achat.' </h4>
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
            foreach ($produits as $produit) 
            {
                    

                    $code_produit=$produit->code_produit;
               
                    $id_prod=$produit->id;

                    $id_pre_achat=$produit->id_pre_achat;

                    $quantite=$produit->qte_demande;

                    $prix=$produit->prix;

                    $designation=DB::select("select description from produits where  code_produit='$code_produit'");

                    

                        
                    $html.='<tr class="item">
                    
                    <td>
                        '.$code_produit.'
                    </td>
                    <td>

                        '.$designation[0]->description.'
                    </td>
                    <td align="right">
                        '.$quantite.'
                    </td>
                    <td align="right">
                    '.$prix.'
                    </td>
                    <td align="right">
                    '.$prix*$quantite.'
                    </td>
                </tr>';

                $total=$total+$prix*$quantite;
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
        $dompdf->stream("BC", array('Attachment'=>1));

        }



        else
        {

        $now = Carbon::now()->format('d/m/Y');
        
        $produits=DB::select("select  p.id,p.code_produit,l.prix,l.qte_demande,l.id_pre_achat
          from ligne_produit l, produits p 
          where p.id=l.id_produit and l.id_pre_achat='$idpreachat' ");

         $id_fournisseur=DB::select("select id_fournisseur from pre_achat where id='$idpreachat' ");

         $id_fournisseur=$id_fournisseur[0]->id_fournisseur;
        
         $fournisseurs=DB::select("select * from fournisseurs where  id='$id_fournisseur'");

         $pre_achat=DB::select("select * from pre_achat where  id='$idpreachat'");

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
                  <h3 style="text-align: center;">N°: '.$pre_achat[0]->num_bc.'   - Date: '.$now.' </h3>
                  <hr>
                  <h3 style="text-align: center;"> IDENTIFICATION DU SERVICE CONTRACTANT </h3>
                  <hr>
                  <h4 style="text-align: center;">Dénomination: SARL ALGEMATIC</h4>
                  <h4>Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.</h4>
                  <hr>
                  <h3 style="text-align: center;"> IDENTIFICATION DU PRESTATAIRE </h3>
                  <hr>
                    <h4 style="text-align: center;">'.$fournisseurs[0]->nom.' </h4>
                    <h4 style="text-align: center;">Relatif à la Facture Pro Format N° '.$pre_achat[0]->num_facture_proformat.' du '.$pre_achat[0]->date_achat.' </h4>
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
            foreach ($produits as $produit) 
            {
                    

                    $code_produit=$produit->code_produit;
               
                    $id_prod=$produit->id;

                    $id_pre_achat=$produit->id_pre_achat;

                    $quantite=$produit->qte_demande;

                    $prix=$produit->prix;

                    $designation=DB::select("select description from produits where  code_produit='$code_produit'");

                    

                        
                    $html.='<tr class="item">
                    
                    <td>
                        '.$code_produit.'
                    </td>
                    <td>

                        '.$designation[0]->description.'
                    </td>
                    <td align="right">
                        '.$quantite.'
                    </td>
                    <td align="right">
                    '.$prix.'
                    </td>
                    <td align="right">
                    '.$prix*$quantite.'
                    </td>
                </tr>';

                $total=$total+$prix*$quantite;
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
        $dompdf->stream("BC", array('Attachment'=>1));
        }


	 }

	 public function AddAchat(Request $request,$idPreAchat)
     {
         $this->validate($request,[
            'bl' => 'required|max:100',
            'facture' => 'required|max:100',
            'decharge' => 'required|max:100',
            'attachement' => 'required|max:100'
            ]);

        $facture=$request->input('facture');
        $info=DB::select("select * from bl_achat where facture='$facture'");
       
        

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Cette Facture  existe déja  !!! ');

                return redirect()->back(); 
               }
        else
               {
                    $file_extension= $request->photofacture->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photofacture->move($path,$file_name);
                    $photofacture=$file_name;

                    $file_extension= $request->photobl->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photobl->move($path,$file_name);
                    $photobl=$file_name;

                    $file_extension= $request->photoattachement->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photoattachement->move($path,$file_name);
                    $photoattachement=$file_name;

                    $file_extension= $request->photodecharge->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photodecharge->move($path,$file_name);
                    $photodecharge=$file_name;

                    $numbl=$request->input('bl');
                    $attachement=$request->input('attachement');
                    $decharge=$request->input('decharge');
                    $facture=$request->input('facture');
                    $date=$request->input('date');
                    $nature_doc=$request->input('doc');

                    $now = Carbon::now()->format('d/m/Y');


                    DB::insert("insert into bl_achat (num_bl,photo_bl,  num_decharge,photo_decharge,num_attachement,photo_attachement,facture,photo_facture) 
                        values('$numbl','$photobl','$decharge','$photodecharge','$attachement','$photoattachement','$facture','$photofacture') ");

                    $id_bl_achat=DB::select("select id from bl_achat where num_bl='$numbl' ");

                    $id_bl_achat=$id_bl_achat[0]->id;

                    DB::insert("insert into achat (id_pre_achat,id_nature_doc,id_bl_achat) 
                        values('$idPreAchat','$nature_doc','$id_bl_achat') ");
                    
                    DB::update("update pre_achat p set achat_done=1 where p.id='$idPreAchat' ");
                    
                    return redirect('/home/achats/DemandeAttente')->with('success','Achat enregistré avec succée');

                }
       



     }


					//Rangemant dant arrivages

     public function Ranger(Request $request,$idPreAchat)
     {

     	DB::update("update pre_achat p set ranger=1 where p.id='$idPreAchat' ");

     	DB::update("update ligne_produit p set ranger=1 where p.id='$idPreAchat' ");

     	$employe=$request->input('employe');

     	$produits=DB::select("select id,id_produit,qte_demande as quantite,prix from ligne_produit where id_pre_achat='$idPreAchat'");

     	$i=0;
     	$j=0;
     	
 
     	$infos=$request->all();

     	foreach ($infos as $info ) 
     	{
     		if($i > 1)
     		{	
     			$id_produit=$produits[$j]->id_produit;

     			$quantite=$produits[$j]->quantite;

     			$prix=$produits[$j]->prix;

     			DB::insert("insert into arrivages (id_produit,id_etagere,id_employe,quantite,prix) 
                       values('$id_produit','$info','$employe','$quantite','$prix') ");


     			$exist=DB::select("select * from stocks where id_produit='$id_produit'");

     			if(count($exist)==0)
     			{
     				DB::insert("insert into stocks (id_produit,quantite) 
                       values('$id_produit','$quantite') ");
     			}

     			else
     			{
     				$OldQuantite=$exist[0]->quantite;

     				$NewQuantite=$OldQuantite+$quantite;

     				DB::update("update stocks p set quantite='$NewQuantite' where p.id_produit='$id_produit' ");
     				DB::update("update stocks p set prix='$prix' where p.id_produit='$id_produit' ");


     			}

     			$j=$j+1;
     		}

     		$i=$i+1;
     	}

     		return redirect('/DemandeAttente')->with('success','Stockage effectué avec succée');

     }


      public function indexJoint()
     {


        dd("DemandeAchatController function indexJoint   pas encore (paramètre que Salim peut le change)");
      $id = Auth::id();
      $actuel = User::FindOrFail($id);

      

      $produits=DB::select("select * from produits");
      $fournisseurs=DB::select("select * from fournisseurs");
        

      
      return view('Achat\DemandeAchatPrestation',compact('produits','fournisseurs'));
     }



     public function indexPrestation()
     {

      $id = Auth::id();
      $actuel = User::FindOrFail($id);

      

      $produits=DB::select("select * from produits");
      $fournisseurs=DB::select("select * from fournisseurs where anonyme='non'");
      $anonymes=DB::select("select * from fournisseurs where anonyme='yes'");
      $types=DB::select("select * from type_pieces");
        

      
      return view('Achat\DemandeAchatPrestation',compact('produits','fournisseurs','types','anonymes'));
     }


        public function AddDemandeAchatPrestation(Request $request)
     {

      dd($request->all());
      
      $testanonyme=$request->anonyme;

      $testjoint=$request->joint;

      $testremise=$request->RemiseYN;

      

      
      return view('Achat\DemandeAchatPrestation',compact('produits','fournisseurs','types'));
     }

}
