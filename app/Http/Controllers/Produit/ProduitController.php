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
    	$produits=DB::select("select p.id,p.code_produit,p.description,p.photo,p.model,p.id_unite,u.description as UniteDescription,p.id_fabricant,f.nom as NomFabricant,p.id_sous_famille,s.nom as NomFamille
             from produits p,unites u, fabricants f,sous_familles s 
            where p.id_unite=u.id and p.id_sous_famille=s.id and p.id_fabricant=f.id and p.visible=1");

    	
    	return view('Produit\produit',compact('fabricants','produits','sfamilles','unites'));
     }

     public function AddProduit(Request $request)
    {   

        
        //dd($request->photo);

        $this->validate($request,[
            'code' => 'required|max:300',
            'description' => 'required|max:800',
            'model' => 'required|max:400',


            //'photo' => 'required|image|max:5000'
            ]);

        
        $testnom=$request->input('code');
        $info=DB::select("select description from produits where code_produit='$testnom'");
       

         if (count($info)>0) 
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

            $produit_unite=$request->input('unite');
            $produit_sfamille=$request->input('sfamille');
            $produit_fabricant=$request->input('fabricant');
            $produit_code=$request->input('code');
            $produit_description=$request->input('description');
            $produit_model=$request->input('model');
            $produit_photo=$file_name;
            //$depot->save();

            DB::insert("insert into produits (id_unite,code_produit,description,photo,model,id_sous_famille,id_fabricant) values('$produit_unite','$produit_code','$produit_description','$produit_photo','$produit_model','$produit_sfamille','$produit_fabricant') ");
            
            
            return redirect('/produit')->with('success','Le Nouveau Produit est enregistré avec succée');
        }
    }
    


}
