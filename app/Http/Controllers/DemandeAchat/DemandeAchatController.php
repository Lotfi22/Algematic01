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


   public function DemandeAttente2()
   {

        

      $presachats=DB::select("select *,p.id as idpreachat from pre_achat p,fournisseurs f where p.id_fournisseur=f.id  ");

      $pieces=DB::select(" select *,p.id as IdPiece from pieces p, type_pieces t
                            where p.id_type=t.id ");
      
      $nature_doc_payments=DB::select("select * from nature_doc_payment");

      $produits=DB::select("select * from stocks");

      $produits2=DB::select("select *,d.id as id_produit,l.id_pre_achat,d.code_produit,l.id_produit,l.qte_demande,l.prix as nv_prix,d.photo,d.data
            from  ligne_produit l, produits d
            where l.id_produit=d.id  ");

     
      $nvproduits=DB::select("select l.id_produit,l.id_pre_achat,p.code_produit,p.description
        from ligne_produit l, produits p where l.id_produit=p.id");


      $employes=DB::select("select * from employes ");
      
      $etageres=DB::select("select * from etageres where id not in ( select id_etagere from arrivages) ");

      $id = Auth::id();
      $actuel = User::FindOrFail($id);

      $privilege=$actuel->privilege;

      
      return view('Achat\AchatAttente2',compact('presachats','nature_doc_payments','privilege','produits','employes','etageres','nvproduits','produits2','pieces'));

   }


   /*Telecharger une piece*/

    public function TelechargerPiece($IdPiece)
    {

      
      
       $MaPiece=DB::select(" select * from pieces where id='$IdPiece'");

       $piece=$MaPiece[0]->piece;

       $file=public_path()."/images/achat/$piece";

       $extention = pathinfo($piece, PATHINFO_EXTENSION);

       if($extention == 'jpg')
       {

          $headers= array('Content_type:  application/jpg');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'jpeg')
       {

          $headers= array('Content_type:  application/jpeg');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'PNG')
       {

          $headers= array('Content_type:  application/PNG');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'pdf')
       {

          $headers= array('Content_type:  application/pdf');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'doc')
       {

          $headers= array('Content_type:  application/doc');

          return Response::download($file,"PieceJointe",$headers);
       }


       if($extention == 'xlsx')
       {

          $headers= array('Content_type:  application/xlsx');

          return Response::download($file,"PieceJointe",$headers);
       }

       

       

       
    }



    public function TelechargerProduitPhoto($IdProduit)
    {

      
      
       $MaPiece=DB::select(" select * from produits where id='$IdProduit'");

       $piece=$MaPiece[0]->photo;

       $file=public_path()."/images/produit/$piece";

       $extention = pathinfo($piece, PATHINFO_EXTENSION);

       if($extention == 'jpg')
       {

          $headers= array('Content_type:  application/jpg');

          return Response::download($file,"PhotoProduit",$headers);
       }

       if($extention == 'jpeg')
       {

          $headers= array('Content_type:  application/jpeg');

          return Response::download($file,"PhotoProduit",$headers);
       }

       if($extention == 'PNG')
       {

          $headers= array('Content_type:  application/PNG');

          return Response::download($file,"PhotoProduit",$headers);
       }

       if($extention == 'pdf')
       {

          $headers= array('Content_type:  application/pdf');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'doc')
       {

          $headers= array('Content_type:  application/doc');

          return Response::download($file,"PieceJointe",$headers);
       }


       if($extention == 'xlsx')
       {

          $headers= array('Content_type:  application/xlsx');

          return Response::download($file,"PieceJointe",$headers);
       }

       

       

       
    }


    public function TelechargerProduitFiche($IdProduit)
    {

      
      
       $MaPiece=DB::select(" select p.piece from proprietes p
        where p.id_produit='$IdProduit' and p.id_type=(select id from type_pieces t where t.type='fiche technique')  ");

      

       $piece=$MaPiece[0]->piece;

       $file=public_path()."/images/produit/$piece";

       $extention = pathinfo($piece, PATHINFO_EXTENSION);

       if($extention == 'jpg')
       {

          $headers= array('Content_type:  application/jpg');

          return Response::download($file,"FicheProduit",$headers);
       }

       if($extention == 'jpeg')
       {

          $headers= array('Content_type:  application/jpeg');

          return Response::download($file,"FicheProduit",$headers);
       }

       if($extention == 'PNG')
       {

          $headers= array('Content_type:  application/PNG');

          return Response::download($file,"FicheProduit",$headers);
       }

       if($extention == 'pdf')
       {

          $headers= array('Content_type:  application/pdf');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'doc')
       {

          $headers= array('Content_type:  application/doc');

          return Response::download($file,"PieceJointe",$headers);
       }


       if($extention == 'xlsx')
       {

          $headers= array('Content_type:  application/xlsx');

          return Response::download($file,"PieceJointe",$headers);
       }

       

       

       
    }


    public function TelechargerProduitCaracteristique($IdProduit)
    {


        $MonProduit=DB::select("select * from produits where id='$IdProduit' ");

        $proprietes=DB::select(" select * from proprietes where id_produit='$IdProduit' ");
        
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
                      <h2 style="text-align: center;">Caractéristiques Téchniques du Produit</h2>
                      <h3 style="text-align: center;">Produit: '.$MonProduit[0]->code_produit.'   </h3>
                     

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
                <th>Designation</th>
                <th>Description</th>
                
              </tr>
            </thead>
            <tbody>';
           
            foreach ($proprietes as $propre) 
            {
                    

               

                    $Designation=$propre->specificite;

                    $Description=$propre->specification;

                    

                    

                        
                    $html.='<tr class="item">
                    
                    <td>
                        '.$Designation.'
                    </td>
                    <td>

                        '.$Description.'
                    </td>
                   
                </tr>';

               
            }

            

           

        $html.='
            </tbody>
            <tfoot>';
           
            
            $html.='</tfoot>
          </table>
          

        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("CaracteristiquesProduit", array('Attachment'=>1));


    }




	 public function DemandeAttente()
	 {

        

    	$presachats=DB::select("select * from pre_achat p,fournisseurs f where p.id_fournisseur=f.id ");

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
   
       session()->flash('success' , ' La demande a été refusé avec succé ');

            return redirect()->back(); 

	 }




	  public function ValiderPreAchat(Request $request,$idpreachat)
	 {

        $test=DB::select("select * from pre_achat where id='$idpreachat' ");

        $IdFournisseur=$test[0]->id_fournisseur;

        $FournisseurTest=DB::select(" select * from fournisseurs where id='$IdFournisseur' ");

        $TestAnnonyme=$FournisseurTest[0]->anonyme;

        if($TestAnnonyme == 'oui') /* In this case we musn't edit a BC*/
        {
            DB::update("update pre_achat f set demande_valide=1 where  f.id='$idpreachat' ");

            session()->flash('success' , ' Demande Validé Avec succée ');

            return redirect()->back(); 

        }

        if($test[0]->demande_valide == 0)
        {



      	   	$year = Carbon::now()->format('Y');

      	    $pre=DB::select("select count(*) as number from pre_achat where annee_bc='$year' and id <> '$idpreachat' and id_fournisseur <> (select id from fournisseurs where anonyme='oui') and demande_valide='1' ");


      	     $nbNumBCExistant= $pre[0]->number;

      	     $nbNumBCExistant= $nbNumBCExistant+1;

      	     $NewNumBC= $nbNumBCExistant."/".$year;

      	     $now = Carbon::now()->format('d/m/Y');

      	     DB::update("update pre_achat f set num_bc='$NewNumBC' where f.id='$idpreachat'  ");
      	     DB::update("update pre_achat f set annee_bc='$year' where f.id='$idpreachat' ");
      	     DB::update("update pre_achat f set demande_valide=1 where  f.id='$idpreachat' ");

      	     $produits=DB::select("select  p.id,p.code_produit,l.prix,l.qte_demande,l.id_pre_achat
      	      from ligne_produit l, produits p 
      	      where p.id=l.id_produit and l.id_pre_achat='$idpreachat' ");

      	     $id_fournisseur=DB::select("select id_fournisseur from pre_achat where id='$idpreachat' ");

      	     $id_fournisseur=$id_fournisseur[0]->id_fournisseur;
          	
      	     $fournisseurs=DB::select("select * from fournisseurs where  id='$id_fournisseur'");

      	     $pre_achat=DB::select("select * from pre_achat where  id='$idpreachat'");

             $FacturePro=DB::select(" select numero_piece from pieces 
              where id_pre_achat='$idpreachat'
              and id_type =( select id from type_pieces where type ='fp') ");

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
                        <h4 style="text-align: center;">Dénomination: SARL ALGEMATIC</h4>
                        <h4 style="text-align: center;">Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.</h4>
                        <hr>
                        <h3 style="text-align: center;"> IDENTIFICATION DU PRESTATAIRE </h3>
                        <hr>
                          <h4 style="text-align: center;">'.$fournisseurs[0]->nom.' </h4>
                          <h4 style="text-align: center;">Relatif à la Facture Pro Format N° '.$FacturePro[0]->numero_piece.' du '.$pre_achat[0]->date_achat.' </h4>
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

                  
                  if( $pre_achat[0]->remiseradio  == 'oui' )
                  {
                      if($pre_achat[0]->type_remise =='pourcentage')
                      {

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
                              <h5 style="text-align: center;"><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
                              <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>

                            </body>
                            </html>';

                            $dompdf->loadHtml($html);
                            $dompdf->render();
                            $dompdf->stream("BC", array('Attachment'=>1));

                            session()->flash('success' , ' Télechargement terminé ');

                            return redirect()->back(); 

                      }
                      else
                      {

                        $prix_remise=$pre_achat[0]->remise;
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
                                        <td align="right">Montant Remise  </td>
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
                              <h5 style="text-align: center;" ><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
                              <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>

                            </body>
                            </html>';

                            $dompdf->loadHtml($html);
                            $dompdf->render();
                            $dompdf->stream("BC", array('Attachment'=>1));

                            session()->flash('success' , ' Télechargement terminé ');

                            return redirect()->back();


                      }
                  }
                  
            else
            {

                        $total_HT=$total;
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

                            session()->flash('success' , ' Télechargement terminé  ');

                            return redirect()->back();

            }     
                  

              

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

         $FacturePro=DB::select(" select numero_piece from pieces 
        where id_pre_achat='$idpreachat'
        and id_type =( select id from type_pieces where type ='fp') ");

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
                <h2><B>SARL ALGEMATIC</B></h2>
                  <h3 style="text-align: center;">BON DE COMMANDE</h3>
                  <h5 style="text-align: center;">N°: '.$pre_achat[0]->num_bc.'   - Date: '.$now.' </h5>
                  <hr>
                  <h5 style="text-align: center;"> IDENTIFICATION DU SERVICE CONTRACTANT </h5>
                  <hr>
                  <h5 style="text-align: center;">Dénomination: SARL ALGEMATIC</h5>
                  <h5 style="text-align: center;">Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger.</h5>
                  <hr>
                  <h3 style="text-align: center;"> IDENTIFICATION DU PRESTATAIRE </h3>
                  <hr>
                    <h5 style="text-align: center;">'.$fournisseurs[0]->nom.' </h5>
                    <h5 style="text-align: center;">Relatif à la Facture Pro Format N° '.$FacturePro[0]->numero_piece.' du '.$pre_achat[0]->date_achat.' </h5>
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

            


            if( $pre_achat[0]->remiseradio  == 'oui' )
                  {
                      if($pre_achat[0]->type_remise =='pourcentage')
                      {
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
                        <h6>Arrête le présent Bon de Commande à la somme de:</h6>
                        <br>
                        <h6 style="text-align: right;">Cachet et signature</h6>
                        <br>
                        <hr>
                        <h6><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h6>
                        <h6><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h6>

                      </body>
                      </html>';

                      $dompdf->loadHtml($html);
                      $dompdf->render();
                      $dompdf->stream("BC", array('Attachment'=>1));

                      session()->flash('success' , ' Télechargement terminé ');

                            return redirect()->back();

                    }
                    else
                    {
                          $prix_remise=$pre_achat[0]->remise;
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
                                  <td align="right">Montant Remise </td>
                                  <td align="right"> '.$pre_achat[0]->remise.' </td>
                                  
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
                        <h6>Arrête le présent Bon de Commande à la somme de:</h6>
                        <br>
                        <h6 style="text-align: right;">Cachet et signature</h6>
                        <br>
                        <hr>
                        <h6><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h6>
                        <h6><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h6>

                      </body>
                      </html>';

                      $dompdf->loadHtml($html);
                      $dompdf->render();
                      $dompdf->stream("BC", array('Attachment'=>1));

                      session()->flash('success' , ' Télechargement terminé ');

                            return redirect()->back();
                    }
        }
        else
        {
          $total_HT=$total;
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
                              <h6>Arrête le présent Bon de Commande à la somme de:</h6>
                              <br>
                              <h6 style="text-align: right;">Cachet et signature</h6>
                              <br>
                              <hr>
                              <h6><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h6>
                              <h6><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h6>

                            </body>
                            </html>';

                            $dompdf->loadHtml($html);
                            $dompdf->render();
                            $dompdf->stream("BC", array('Attachment'=>1));

                            session()->flash('success' , ' Télechargement terminé ');

                            return redirect()->back();
        }


	 }
  }

	 public function AddAchat(Request $request,$idPreAchat)
     {
         


       
      $now = Carbon::now()->format('d/m/Y');

      $fullnametestjoint="joint".$idPreAchat;

      $testjoint=$request->$fullnametestjoint;
        
      $AllPreAchatIDS=("select id from pre_achat");  

      $nature_doc_payment=$request->doc;




                  


      if($testjoint == 'yes')   /* Yap there is a document like BL ATTACHMENT... to save it in achat_document*/
      {   

         

          foreach ($request['dynamic_form'.$idPreAchat]['dynamic_form'.$idPreAchat] as $key=>$array) 
            {

                $index = $key +1;

                $IdTypePiece=$array['typepiece'];
              
                $facture=$array['facture'];

                $date=$array['date'];


                $file_extension= $array['photo']->getClientOriginalExtension();
                $file_name=time().'.'.$file_extension;
                $path='images/achat';
                $array['photo']->move($path,$file_name);
                $photofacture=$file_name;


                
                 DB::insert("insert into achat_document(id_pre_achat ,id_type,piece,date_Piece,numero_piece, date_Ajout)
                  values('$idPreAchat','$IdTypePiece','$photofacture','$date','$facture','$now')");
            

            }



      }

        DB::insert("insert into achat(id_pre_achat ,id_nature_payement)
                  values('$idPreAchat','$nature_doc_payment')");
                 
                    
        DB::update("update pre_achat p set achat_done=1 where p.id='$idPreAchat' ");
        
        return redirect('/home/achats/DemandeAttente2')->with('success','Achat enregistré avec succée');

             
       



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
      $fournisseurs=DB::select("select * from fournisseurs");
   
      $types=DB::select("select * from type_pieces");
        

      
      return view('Achat\DemandeAchatPrestation',compact('produits','fournisseurs','types'));
     }




/*******************************************************************************************************/



        public function AddDemandeAchatPrestation(Request $request)
     {

      

      $TypeAchat=$request->TypeAchat; /*done*/
      
      

      $testjoint=$request->joint;     /*done*/

      $testremise=$request->RemiseYN;  /*done*/

      $testProduitYN=$request->ProduitYN; /*done*/

      $type_remise=$request->typepourcentage;

      $now = Carbon::now()->format('d/m/Y');


            /*savoir le type de fournisseur*/



     
      $fournisseur=$request->fournisseur;

   

     

       

        if($testremise == 'yes')
        {
         
            $remise=$request->input('remise');

           

                DB::insert("insert into pre_achat (id_fournisseur,date_achat,remise,type_remise,typeachat) 
                           values('$fournisseur','$now','$remise', '$type_remise' ,'$TypeAchat') ");

           

          
        }

      else
      {


                DB::insert("insert into pre_achat (id_fournisseur,date_achat,remiseradio, typeachat) 
                           values('$fournisseur','$now','$testremise','$TypeAchat') ");

               

           
       

      }



      $NewPreAchat=DB::select("select id from pre_achat where id=(select max(id) from pre_achat)");

      $id_pre_achat=$NewPreAchat[0]->id;



           /* si la saisie des produits alors insertions dans ligne produits */

      if($testProduitYN == 'yes')   
      {
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

            DB::update("update pre_achat p set montant='$total' where p.id='$id_pre_achat' ");


      }


                /* si la saisie des pieces jointes (fap, contart ....) */

       if($testjoint == 'non')    
      { 

          DB::update("update pre_achat p set pieces_jointes='$testjoint' where p.id='$id_pre_achat' ");

      }

      else  /* Yap there is a product to regster it !! let's go*/
      {

          foreach ($request['dynamic_form2']['dynamic_form2'] as $key=>$array) 
            {

                $index = $key +1;

                $IdTypePiece=$array['typepiece'];
              
                $facture=$array['facture'];

                $date=$array['date'];


                $file_extension= $array['photo']->getClientOriginalExtension();
                $file_name=time().'.'.$file_extension;
                $path='images/achat';
                $array['photo']->move($path,$file_name);
                $photofacture=$file_name;

                

                
                 DB::insert("insert into pieces (id_type, id_pre_achat, piece,date_Piece, numero_piece, date_Ajout) 
                values('$IdTypePiece','$id_pre_achat','$photofacture','$date','$facture','$now') ;");
            

            }



      }



      return redirect('/home/achats/DemandeAchatPrestation')->with('success','La demande a été envoyé avec succée');

      //return view('Achat\DemandeAchatPrestation',compact('produits','fournisseurs','types'));
     }


     /********************************ARRIVAG**************************************************************/

     public function AchatArrivage()
     {

       

       $presachats=DB::select("select *,p.id as idpreachat from pre_achat p,fournisseurs f where p.id_fournisseur=f.id and p.demande_valide='1' ");

       $pieces=DB::select(" select *,p.id as IdPiece from pieces p, type_pieces t
                            where p.id_type=t.id ");
      
      $nature_doc_payments=DB::select("select * from nature_doc_payment");

      $produits=DB::select("select * from stocks");

      $produits2=DB::select("select *,d.id as id_produit,l.id_pre_achat,d.code_produit,l.id_produit,l.qte_demande,l.prix as nv_prix,d.photo,d.data
            from  ligne_produit l, produits d
            where l.id_produit=d.id  ");

      $types=DB::select("select * from type_pieces");

     
      $nvproduits=DB::select("select l.id_produit,l.id_pre_achat,p.code_produit,p.description
        from ligne_produit l, produits p where l.id_produit=p.id");

      $employes=DB::select("select * from employes ");
      
      $etageres=DB::select("select * from etageres where id not in ( select id_etagere from arrivages) ");

      $id = Auth::id();
      $actuel = User::FindOrFail($id);

      $privilege=$actuel->privilege;

      
      return view('Achat\AchatArrivage',compact('presachats','nature_doc_payments','privilege','produits','employes','etageres','nvproduits','produits2','pieces','types'));


   
     }


     public function Rangement()
     {
        
       $presachats=DB::select("select *,p.id as idpreachat from pre_achat p,fournisseurs f where p.id_fournisseur=f.id and p.demande_valide='1' and p.achat_done='1' ");

       $pieces=DB::select(" select *,p.id as IdPiece from pieces p, type_pieces t
                            where p.id_type=t.id ");
      
      $nature_doc_payments=DB::select("select * from nature_doc_payment");

      $produits=DB::select("select * from stocks");

      $produits2=DB::select("select *,d.id as id_produit,l.id_pre_achat,d.code_produit,l.id_produit,l.qte_demande,l.prix as nv_prix,d.photo,d.data
            from  ligne_produit l, produits d
            where l.id_produit=d.id  ");

      $types=DB::select("select * from type_pieces");

     
      $nvproduits=DB::select("select l.id_produit,l.id_pre_achat,p.code_produit,p.description
        from ligne_produit l, produits p where l.id_produit=p.id");

      $employes=DB::select("select * from employes ");
      
      $etageres=DB::select("select * from etageres where id not in ( select id_etagere from arrivages) ");

      $PieceAchat=DB::select("select *,a.id as IdPiece from achat_document a,type_pieces t 
        where a.id_type=t.id ");

      $id = Auth::id();
      $actuel = User::FindOrFail($id);

      $privilege=$actuel->privilege;


        return view('Achat\Rangement',compact('presachats','nature_doc_payments','privilege','produits','employes','etageres','nvproduits','produits2','pieces','types','PieceAchat'));
     }


     public function TelechargerPieceAchat($IdPiece)
    {

      
      
       $MaPiece=DB::select(" select * from achat_document where id='$IdPiece'");

       $piece=$MaPiece[0]->piece;

       $file=public_path()."/images/achat/$piece";

       $extention = pathinfo($piece, PATHINFO_EXTENSION);

       if($extention == 'jpg')
       {

          $headers= array('Content_type:  application/jpg');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'jpeg')
       {

          $headers= array('Content_type:  application/jpeg');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'PNG')
       {

          $headers= array('Content_type:  application/PNG');

          return Response::download($file,"PhotoJointe",$headers);
       }

       if($extention == 'pdf')
       {

          $headers= array('Content_type:  application/pdf');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'docx')
       {

          $headers= array('Content_type:  application/docx');

          return Response::download($file,"PieceJointe",$headers);
       }

       if($extention == 'doc')
       {

          $headers= array('Content_type:  application/doc');

          return Response::download($file,"PieceJointe",$headers);
       }


       if($extention == 'xlsx')
       {

          $headers= array('Content_type:  application/xlsx');

          return Response::download($file,"PieceJointe",$headers);
       }

       

       

       
    }

    public function RangerPreAchat($idpreachat)
    {


        $presachats=DB::select("select *,p.id as idpreachat from pre_achat p,fournisseurs f 
          where p.id_fournisseur=f.id and p.id='$idpreachat'   ")[0];

        $nvproduits=DB::select("select *,l.id as ligneId from ligne_produit l,produits p  where l.id_pre_achat='$idpreachat' and l.id_produit=p.id and l.ranger='0' ");

        $employes=DB::select("select * from employes ");
      
        $etageres=DB::select("select *,e.id as IdEtagere,r.nom as nomRayon,l.nom as nomLocal from etageres e,rayons r,locals l,depots d where e.id_rayon=r.id and r.id_local=l.id and l.id_depot=d.id ");

        $id = Auth::id();

        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;




        return view('Achat\stocker',compact('presachats','nvproduits','employes','etageres','privilege'));
    }


    /**********************  PLACEMENT (Rangement) du produit*********************************/

    public function Placement(Request $request,$idpreachat,$idProduit)
    {
      
        $idEtagere=$request->etagere;

        $id = Auth::id();



       $produit=DB::select("select * from ligne_produit where id_produit='$idProduit' and id_pre_achat='$idpreachat' ")[0];

       $quantite=$produit->qte_demande;

       $prix=$produit->prix;

       
       DB::insert("insert into arrivages (id_produit,id_etagere,id_employe,quantite,prix) 
                       values('$idProduit','$idEtagere','$id','$quantite','$prix') ");

       DB::update(" update ligne_produit l set ranger='1' where l.id_pre_achat='$idpreachat' and l.id_produit='$idProduit' ");



         $exist=DB::select("select * from stocks where id_produit='$idProduit'");

          if(count($exist)==0)
          {
            DB::insert("insert into stocks (id_produit,quantite,prix) 
                       values('$idProduit','$quantite','$prix') ");
          }

          else
          {
            $OldQuantite=$exist[0]->quantite;

            $NewQuantite=$OldQuantite+$quantite;

            DB::update("update stocks p set quantite='$NewQuantite' where p.id_produit='$idProduit' ");
            DB::update("update stocks p set prix='$prix' where p.id_produit='$idProduit' ");


          }

          

        $RangementNotYet=DB::select("select count(*) as nb from ligne_produit l where l.id_pre_achat='$idpreachat' and l.ranger='0'  ");

         $test=$RangementNotYet[0]->nb;

          if($test==0)
          {

              DB::update("update pre_achat p set ranger='1' where p.id='$idpreachat' ");

             

              $presachats=DB::select("select *,p.id as idpreachat from pre_achat p,fournisseurs f where p.id_fournisseur=f.id and p.demande_valide='1' and p.achat_done='1' ");

           $pieces=DB::select(" select *,p.id as IdPiece from pieces p, type_pieces t
                                where p.id_type=t.id ");
          
          $nature_doc_payments=DB::select("select * from nature_doc_payment");

          $produits=DB::select("select * from stocks");

          $produits2=DB::select("select *,d.id as id_produit,l.id_pre_achat,d.code_produit,l.id_produit,l.qte_demande,l.prix as nv_prix,d.photo,d.data
                from  ligne_produit l, produits d
                where l.id_produit=d.id  ");

          $types=DB::select("select * from type_pieces");

         
          $nvproduits=DB::select("select l.id_produit,l.id_pre_achat,p.code_produit,p.description
            from ligne_produit l, produits p where l.id_produit=p.id");

          $employes=DB::select("select * from employes ");
          
          $etageres=DB::select("select * from etageres where id not in ( select id_etagere from arrivages) ");

          $PieceAchat=DB::select("select *,a.id as IdPiece from achat_document a,type_pieces t 
            where a.id_type=t.id ");

          $id = Auth::id();
          $actuel = User::FindOrFail($id);

          $privilege=$actuel->privilege;


            return view('Achat\Rangement',compact('presachats','nature_doc_payments','privilege','produits','employes','etageres','nvproduits','produits2','pieces','types','PieceAchat'));
          }

          else
           {
              session()->flash('success' , ' Produit Ranger Avec succée ');

                return redirect()->back(); 

           } 

          

    }
}
