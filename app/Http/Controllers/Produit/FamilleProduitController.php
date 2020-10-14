<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FamilleProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$familles=DB::select("select * from familles where visible=1");
    	$categories=DB::select("select * from categories where visible=1");

    	
    	return view('Produit\famille',compact('familles','categories'));
     }

     public function AddFamilleProduit(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800'
            ]);

    	$testnom=$request->input('nom');
        $info=DB::select("select description  from familles where nom='$testnom'");
       

         if (count($info) >0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de Famille_Produit existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$famille_categorie=$request->input('categorie');
		        $famille_nom=$request->input('nom');
		        $famille_description=$request->input('description');
		        //$depot->save();

		        DB::insert("insert into familles (id_categorie,nom,description) values('$famille_categorie','$famille_nom','$famille_description') ");
		        
		        
		        return redirect('/familleProd')->with('success','La Famille est enregistré avec succée');	
		}
        

    }

    public function ModifFamilleProduit(Request $request,$idFamilleProduitModiff)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800'
            ]);

    	$testnom=$request->input('nom');
        $info=DB::select("select description  from familles where nom='$testnom'");
       

         if (count($info) >1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de Famille_Produit existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$famille_categorie=$request->input('categorie');
		        $famille_nom=$request->input('nom');
		        $famille_description=$request->input('description');
		        

		         DB::update("update familles f set id_categorie='$famille_categorie' ,nom='$famille_nom',description='$famille_description ' where f.id='$idFamilleProduitModiff'  ");
       			 return redirect('/familleProd')->with('success','La Famiile a été Modifiée avec succée');
		}
        

    }

    public function SupprimerFamilleProduit(Request $request,$idFamilleProduitSupprimer)
    {
        
        DB::delete("delete from familles  where id='$idFamilleProduitSupprimer'");

        return redirect('/familleProd')->with('success','La Famille a été supprimée avec succée');

    }

}
