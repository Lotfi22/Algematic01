<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class ProprieteController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$proprietes=DB::select("select * from proprietes");
    	
    	return view('Produit\propriete',compact('proprietes'));
     }

     public function AddPropriete(Request $request)
    {
    	
    	$this->validate($request,[
            'description' => 'required|max:800'
            ]);

    	
			
		        $description=$request->input('description');
		        //$depot->save();

		        DB::insert("insert into proprietes (description) values('$description') ");
		        
		        
		        return redirect('/propriete')->with('success','La Propriété est enregistré avec succée');	
		
        

    }

    public function ModifPropriete(Request $request,$idProprieteModiff)
    {
    	
    	$this->validate($request,[
            'description' => 'required|max:800'
            ]);

    	
			
		        $description=$request->input('description');
		        //$depot->save();

		        DB::update("update  proprietes p set description='$description' where p.id='$idProprieteModiff' ");
		        
		        
		        return redirect('/propriete')->with('success','La Propriété a été Modifiée avec succée');	
		
        

    }

     public function SupprimerPropriete(Request $request,$idProprieteSupprimer)
    {
        
        DB::delete("delete from proprietes  where id='$idProprieteSupprimer'");

        return redirect('/propriete')->with('success','La Propriété a été supprimée avec succée');

    }


}
