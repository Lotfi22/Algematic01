<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SousFamilleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$familles=DB::select("select * from familles where visible=1");
    	$Sfamilles=DB::select("select * from sous_familles where visible=1");

    	
    	return view('Produit\Sfamille',compact('familles','Sfamilles'));
     }

     public function AddSousFamille(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800'
            ]);

    	$testnom=$request->input('nom');
        $info=DB::select("select description  from sous_familles where nom='$testnom'");
       

         if (count($info) >0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de Sous_Famille existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$famille_famille=$request->input('famille');
		        $famille_nom=$request->input('nom');
		        $famille_description=$request->input('description');
		        //$depot->save();

		        DB::insert("insert into sous_familles (id_famille,nom,description) values('$famille_famille','$famille_nom','$famille_description') ");
		        
		        
		        return redirect('/home/produits/sousFamille')->with('success','La Sous_Famille est enregistré avec succée');	
		}
        

    }

     public function ModifSousFamille(Request $request,$idSousFamilleModiff)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:800'
            ]);

    	$testnom=$request->input('nom');
        $info=DB::select("select description  from sous_familles where nom='$testnom'");
       

         if (count($info) >1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de Sous_Famille existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$famille_famille=$request->input('famille');
		        $famille_nom=$request->input('nom');
		        $famille_description=$request->input('description');
		        //$depot->save();

		        DB::update("update sous_familles f set id_famille='$famille_famille',nom='$famille_nom',description='$famille_description ' where f.id='$idSousFamilleModiff'  ");
		        
		        
		        return redirect('/home/produits/sousFamille')->with('success','La Sous_Famille a été modofiée avec succée');	
		}
        

    }

    public function SupprimerSousFamille(Request $request,$idSousFamilleSupprimer)
    {
        
        DB::delete("delete from sous_familles  where id='$idSousFamilleSupprimer'");

        return redirect('/home/produits/sousFamille')->with('success','La Sous_Famille a été supprimée avec succée');

    }


}
