<?php

namespace App\Http\Controllers\Parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;

class ParametreController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    	$types=DB::select("select * from type_pieces");

    	
    	return view('Parametre\TypePiece',compact('types'));
    }


    public function AddType(Request $request)
    {	

    	$this->validate($request,[
            'type' => 'required|max:800'
            ]);

    	$testnom=$request->input('type');
        $info=DB::select("select type  from type_pieces where type='$testnom'");
       

         if (count($info) >0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Type existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$type=$request->input('type');
		  
		        //$depot->save();

		        DB::insert("insert into type_pieces (type) values('$type') ");
		        
		        
		        return redirect('/home/parametres/TypeDocument')->with('success','Le nouveau Type est enregistré avec succée');	
		}
    }

     public function ModifierTypeDocument(Request $request,$IdTypeModif)
    {
    	
	    	$this->validate($request,[
	            'type' => 'required|max:800'
	            ]);

    			$testnom=$request->input('type');
        		$info=DB::select("select type  from type_pieces where type='$testnom'");
	       

	         if (count($info) >0) 
	           {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Type existe déja  !!! ');

                return redirect()->back(); 
               }
			
		        else
		        {
		        	$type=$request->input('type');
		        //$depot->save();

		        DB::update("update  type_pieces p set type='$type' where p.id='$IdTypeModif' ");
		        
		        
		        return redirect('/home/parametres/TypeDocument')->with('success','Type Modifié avec succée');
		        }	
		
        

    }

    public function SupprimerTypeDocument(Request $request,$IdTypeSupprimer)
    {
        
        DB::delete("delete from type_pieces  where id='$IdTypeSupprimer'");

        return redirect('/home/parametres/TypeDocument')->with('success','Type supprimée avec succée');

    }




    
}
