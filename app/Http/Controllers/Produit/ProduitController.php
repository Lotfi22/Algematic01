<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;


class ProduitController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$fabricants=DB::select("select id,nom,marque from fabricants");
    	$sfamilles=DB::select("select id,nom from sous_familles where visible=1");
        $unites=DB::select("select id,description from unites");
    	$produits=DB::select("select *,u.description as UniteDescription,p.data,p.id_sous_famille,s.nom as NomFamille
             from produits p,unites u,sous_familles s 
            where p.id_unite=u.id and p.id_sous_famille=s.id  and p.visible=1");
        $prix=DB::select("select s.id_produit,s.prix from stocks s");
        $proprietes=DB::select("select *,p.id as IdPropriete from proprietes p,type_pieces t 
        where p.id_type=t.id  ");
        $types=DB::select("select * from type_pieces");

    	
    	return view('Produit\produit',compact('fabricants','produits','sfamilles','unites','prix','proprietes','types'));
     }



     public function AddProduit(Request $request)
    {   

        
        
        $TestProduitBien=$request->input('ProduitBien');


        $testjoint=$request->input('joint');

          
        $produit_unite=$request->input('unite');
        $produit_sfamille=$request->input('sfamille');
        $produit_code=$request->input('code');
        $produit_description=$request->input('description');
        $produit_model=$request->input('model');
        

        
         DB::insert("insert into produits (id_unite,code_produit,description,model,id_sous_famille,prestation) 
            values('$produit_unite','$produit_code','$produit_description','$produit_model','$produit_sfamille','$TestProduitBien') ");
   
    

            if($testjoint == 'yes')   

              { 

                $NewProdect=DB::select("select id from produits where id=(select max(id) from produits)");

                $IdNewProdect=$NewProdect[0]->id;

                DB::update("update produits p set ficheYN='$testjoint' where p.id='$IdNewProdect' ");

                  $now = Carbon::now()->format('d/m/Y');

                  foreach ($request['dynamic_form2']['dynamic_form2'] as $key=>$array) 
                    {

                        $index = $key +1;

                        $IdTypePiece=$array['typepiece'];
                      
                        $facture=$array['facture'];

                        $date=$array['date'];


                        $file_extension= $array['photoPiece']->getClientOriginalExtension();
                        $file_name=time().'.'.$file_extension;
                        $path='images/produit';
                        $array['photoPiece']->move($path,$file_name);
                        $photofacture=$file_name;

                        
                         DB::insert("insert into proprietes (id_produit, id_type, piece,date_Piece, numero_piece, date_Ajout) 
                        values('$IdNewProdect','$IdTypePiece','$photofacture','$date','$facture','$now') ;");
                    }

              }

     
      
            
            return redirect('/produit')->with('success','Le Nouveau Produit est enregistré avec succée');

    }
    



     public function ModifProduit(Request $request,$idProduitModiff)
    {   

        

        
        $testnom=$request->input('code');
        $info=DB::select("select description from produits where code_produit='$testnom'");
       

         if (count($info)>1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Code_Produit  existe déja  !!! ');

                return redirect()->back(); 
               }
      
        else
        {
            $file_extension= $request->photo->getClientOriginalExtension();
            $file_name=time().'.'.$file_extension;
            $path='images/produit';
            $request->photo->move($path,$file_name);

            $file_extension= $request->detail->getClientOriginalExtension();
            $file_name2=time().'.'.$file_extension;
            $path='images/produit';
            $request->detail->move($path,$file_name2);

            $produit_unite=$request->input('unite');
            $produit_sfamille=$request->input('sfamille');
            $produit_fabricant=$request->input('fabricant');
            $produit_code=$request->input('code');
            $produit_description=$request->input('description');
            $produit_model=$request->input('model');
            $produit_photo=$file_name;
            $produit_detail=$file_name2;
            //$depot->save();

            DB::update("update  produits p set id_unite = '$produit_unite', code_produit= '$produit_code',  description='$produit_description', photo='$produit_photo' ,model='$produit_model',  id_sous_famille='$produit_sfamille' , id_fabricant='$produit_fabricant',data='$produit_detail' 
            where p.id='$idProduitModiff' ");
            
            
            return redirect('/produit')->with('success','Le Produit a été Modifié avec succée');
        }
    }
    
    public function SupprimerProduit(Request $request,$idProduitSupprimer)
    {
        
        DB::delete("delete from produits  where id='$idProduitSupprimer'");

        return redirect('/produit')->with('success','Le Produit a été supprimé avec succée');

    }

    public function ProduitController()
    {

         $stocks=DB::select("select * from stocks s,produits p where p.id=s.id_produit");

        
        return view('Produit\Produit_Stock',compact('stocks'));
    }


     public function TelechargerProduitFicheProduit($IdPropriete)
    {

      
      
       $MaPiece=DB::select(" select * from proprietes where id='$IdPropriete'");

       $piece=$MaPiece[0]->piece;

       $file=public_path()."/images/produit/$piece";

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



}
