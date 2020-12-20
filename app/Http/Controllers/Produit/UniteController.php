<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UniteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$unites=DB::select("select * from unites");
    	
    	return view('Produit\unite',compact('unites'));
     }

      public function AddUnite(Request $request)
    {
    	
    	$this->validate($request,[
            'description' => 'required|max:800'
            ]);

    	
			
		        $description=$request->input('description');
		        //$depot->save();

		        DB::insert("insert into unites (description) values('$description') ");
		        
		        
		        return redirect('/home/produits/unite')->with('success',' Unité enregistrée avec succée');	
		
        

    }

    public function ModifUnite(Request $request,$idUniteModiff)
    {
    	
    	$this->validate($request,[
            'description' => 'required|max:800'
            ]);

    	
			
		        $description=$request->input('description');
		        //$depot->save();

		        DB::update("update  unites p set description='$description' where p.id='$idUniteModiff' ");
		        
		        
		        return redirect('/home/produits/unite')->with('success','Unité Modifiée avec succée');	
		
        

    }

     public function SupprimerUnite(Request $request,$idUniteSupprimer)
    {
        
        DB::update("update  unites p set visible='0' where p.id='$idUniteSupprimer' ");


        return redirect('/home/produits/unite')->with('success','Unitésupprimée avec succée');

    }




}
