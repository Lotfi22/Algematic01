<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


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
        $proprietes=DB::select("select * from proprietes");

    	
    	return view('Produit\produit',compact('fabricants','produits','sfamilles','unites','prix','proprietes'));
     }

     public function AddProduit(Request $request)
    {   

        
        

        $this->validate($request,[
            'code' => 'required|max:300',
            'description' => 'required|max:800'
            ]);

        
        $testnom=$request->input('code');
        $info=DB::select("select description from produits where code_produit='$testnom'");

        $TestProduitBien=$request->input('ProduitBien');

        $TestPhotoYN=$request->input('PhotoYN');

        $TestPieceYN=$request->input('PieceYN');

        $TestFicheYN=$request->input('FicheYN');
       

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Code_Produit  existe déja  !!! ');

                return redirect()->back(); 
               }
      
        else
        {
           
                if($TestPhotoYN =='yes')
                {

                    $file_extension= $request->photo->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/produit';
                    $request->photo->move($path,$file_name);


                    $produit_unite=$request->input('unite');
                    $produit_sfamille=$request->input('sfamille');
                    $produit_code=$request->input('code');
                    $produit_description=$request->input('description');
                    $produit_model=$request->input('model');
                    $produit_photo=$file_name;
  
                    //$depot->save();

                    if($TestPieceYN =='yes')
                    {
                            
                            $file_extension= $request->phototechnique->getClientOriginalExtension();
                            $file_name2=time().'.'.$file_extension;
                            $path='images/produit';
                            $request->phototechnique->move($path,$file_name2);

                            DB::insert("insert into produits (id_unite,code_produit,description,photo,model,id_sous_famille,data,prestation,ficheYN) values('$produit_unite','$produit_code','$produit_description','$produit_photo','$produit_model','$produit_sfamille','$file_name2','$TestProduitBien','$TestFicheYN') ");

                            
                    }
                    else
                    {
                         DB::insert("insert into produits (id_unite,code_produit,description,photo,model,id_sous_famille,pieceYN,prestation,ficheYN) values('$produit_unite','$produit_code','$produit_description','$produit_photo','$produit_model','$produit_sfamille','$TestPieceYN','$TestProduitBien','$TestFicheYN') ");
                    }

                   
                }

                else
                {
                    $produit_unite=$request->input('unite');
                    $produit_sfamille=$request->input('sfamille');
                    $produit_code=$request->input('code');
                    $produit_description=$request->input('description');
                    $produit_model=$request->input('model');
                    
  
                    //$depot->save();

                     if($TestPieceYN =='yes')
                    {
                            
                            $file_extension= $request->phototechnique->getClientOriginalExtension();
                            $file_name2=time().'.'.$file_extension;
                            $path='images/produit';
                            $request->phototechnique->move($path,$file_name2);

                            DB::insert("insert into produits (id_unite,code_produit,description,model,id_sous_famille,data,photoYN,prestation,ficheYN) values('$produit_unite','$produit_code','$produit_description','$produit_model','$produit_sfamille','$file_name2','$TestPhotoYN','$TestProduitBien','$TestFicheYN') ");
                    }
                    else
                    {
                         DB::insert("insert into produits (id_unite,code_produit,description,model,id_sous_famille,pieceYN,photoYN,prestation,ficheYN) values('$produit_unite','$produit_code','$produit_description','$produit_model','$produit_sfamille','$TestPieceYN','$TestPhotoYN','$TestProduitBien','$TestFicheYN') ");
                    }

                }

                /* if caractéristique == oui (dynamique forme)*/

                $NewProdect=DB::select("select id from produits where id=(select max(id) from produits)");
                $IdNewProdect=$NewProdect[0]->id;

                if($TestFicheYN == 'yes')
                {
                        foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
                        {
                                $index = $key +1;

                                $specificite=$array['specificite'];
                                
                                $specification=$array['specification'];
      

                              
                                     DB::insert("insert into proprietes (id_produit,specificite,specification) 
                                    values('$IdNewProdect','$specificite','$specification') ;");
                                
                                    
                            
                        }

                }
            

            
            
            
            return redirect('/produit')->with('success','Le Nouveau Produit est enregistré avec succée');
        }
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


}
