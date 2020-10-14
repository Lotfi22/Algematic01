<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$categories=DB::select("select * from categories where visible=1");

    	
    	return view('Produit\categorie',compact('categories'));
     }

	public function AddCategorie(Request $request)
    {	


    	

    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800',
            //'photo' => 'required|image|max:5000'
            ]);

    	
    	$testnom=$request->input('nom');
        $info=DB::select("select description  from categories where nom='$testnom'");
       
         

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Le Nom de la catégorie existe déja  !!! ');

                return redirect()->back(); 
               }
		
         else
         {
        	
	    	$file_extension= $request->photo->getClientOriginalExtension();
	    	$file_name=time().'.'.$file_extension;
	    	$path='images/categorie';
	    	$request->photo->move($path,$file_name);

	        $categorie_nom=$request->input('nom');
	        $categorie_description=$request->input('description');
	        $categorie_photo=$file_name;
	        //$depot->save();

	        DB::insert("insert into categories (nom,description,photo) values('$categorie_nom','$categorie_description','$categorie_photo') ");
	        
	        
	        return redirect('/categorie')->with('success','La Nouvelle  Catégorie est enregistrée avec succée');

    	}

    }

    public function Modifcategorie(Request $request,$idCategorieModiff)
    {	


    	

    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800',
            //'photo' => 'required|image|max:5000'
            ]);

    	
    	$testnom=$request->input('nom');
        $info=DB::select("select description  from categories where nom='$testnom'");
       
         

         if (count($info)>1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Le Nom de la catégorie existe déja  !!! ');

                return redirect()->back(); 
               }
		
         else
         {
        	
	    	$file_extension= $request->photo->getClientOriginalExtension();
	    	$file_name=time().'.'.$file_extension;
	    	$path='images/categorie';
	    	$request->photo->move($path,$file_name);

	        $categorie_nom=$request->input('nom');
	        $categorie_description=$request->input('description');
	        $categorie_photo=$file_name;
	        //$depot->save();

	           DB::update("update categories c set nom='$categorie_nom',description='$categorie_description',photo='$categorie_photo' where c.id='$idCategorieModiff'  ");
	        
	        
	        return redirect('/categorie')->with('success','La Nouvelle  Catégorie a été modifiée avec succée');

    	}

    }

    public function SupprimerCategorie(Request $request,$idCategorieSupprimer)
    {
        
        DB::update("update  categories c set visible=0  where id='$idCategorieSupprimer'");
        return redirect('/categorie')->with('success','La catégorie a été supprimé avec succée');

    }


}
