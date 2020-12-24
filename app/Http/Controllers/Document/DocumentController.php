<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;


class DocumentController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    	$casiers=DB::select("select * from casiers");

    	
    	return view('Archivage\archivage',compact('casiers'));
    }

    public function indextiroir()
    {

    	$casiers=DB::select("select * from casiers");

    	$tiroirs=DB::select("select c.id,c.description,t.id as idtiroir,t.id_casier,t.numero 
    		from casiers c ,tiroirs t
    		where c.id=t.id_casier  ");

    	
    	return view('Archivage\tiroir',compact('casiers','tiroirs'));
    }



      public function AddCasier(Request $request)
    {	

    	$this->validate($request,[
            'description' => 'required|max:800'
            ]);

    	$testnom=$request->input('description');
        $info=DB::select("select description  from casiers where description='$testnom'");
       

         if (count($info) >0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Casier existe déja  !!! ');

                return redirect()->back(); 
               }
		else
		{
				$description=$request->input('description');
		  
		        //$depot->save();

		        DB::insert("insert into casiers (description) values('$description') ");
		        
		        
		        return redirect('/home/documents/casier')->with('success','Le nouveau Type est enregistré avec succée');	
		}
    }



    public function Addtiroir(Request $request)
    {	

    	$this->validate($request,[
            'numero' => 'required|max:800'
            ]);

    	
				$numero=$request->input('numero');
				$casier=$request->input('casier');
		  
		        //$depot->save();

		        DB::insert("insert into tiroirs (id_casier,numero) values('$casier' ,'$numero') ");
		        
		        
		        return redirect('/home/documents/tiroir')->with('success','Le nouveau Tiroir est enregistré avec succée');	
		
    }
}
