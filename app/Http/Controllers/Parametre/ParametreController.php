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


    public function indextva()
    {

        $tvas=DB::select("select * from tvas");

        
        return view('Parametre\TVA',compact('tvas'));
    }





    public function AddTVA(Request $request)
    {   

        $this->validate($request,[
            'tva' => 'required|max:800'
            ]);

        $testnom=$request->input('tva');
        $info=DB::select("select tva  from tvas where tva='$testnom'");
       

         if (count($info) >0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Cette TVA existe déja  !!! ');

                return redirect()->back(); 
               }
        else
        {
                $tva=$request->input('tva');

                $now = Carbon::now()->format('d/m/Y');
          
                //$depot->save();

                DB::insert("insert into tvas (tva,date_ajout) values('$tva','$now') ");
                
                
                return redirect('/home/parametres/tva')->with('success','Le Nouveau Pourcentage de TVA est enregistré avec succée'); 
        }
    }

    public function ModifierTVA(Request $request,$IdTVAModifier)
    {   

        $this->validate($request,[
            'tva' => 'required|max:800'
            ]);

            $tva=$request->input('tva');
          
                //$depot->save();

                DB::update("update  tvas t set tva = '$tva' where t.id='$IdTVAModifier' ");
                
                
                return redirect('/home/parametres/tva')->with('success',' TVA Modifier Avec Succée'); 
       
    }



     public function SupprimerTVA(Request $request,$IdTVASupprimer)
    {
        
        DB::delete("delete from tvas  where id='$IdTVASupprimer'");

        return redirect('/home/parametres/tva')->with('success','TVA supprimée avec succée');

    }


    
}
