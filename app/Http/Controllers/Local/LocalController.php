<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalController extends Controller
{

    #Hada Howwa l middleware

    public function __construct()
    {
        $this->middleware('auth');
    }

    
	 public function index()
     {
    	$depots=DB::select("select * from depots where visible='1' ");
    	$locals=DB::select("select * from locals where visible='1' ");

        
    	return view('Local\local',compact('depots','locals'));
     }

     public function AddLocal(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:500',
            'description' => 'required|max:800',
            'superficie' => 'required|numeric|between:0,99.1000'
            ]);

    	/*
    	$testnom=$request->input('nom');
        $info=DB::select("select count(*) as number from depots where nom='$testnom'");
       
        $info = (array_pluck($info,'number')[0]); 

         if ($info>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de dépot existe déja  !!! ');

                return redirect()->back(); 
               }
		*/
        $local_Depot=$request->input('depot');
        $local_nom=$request->input('nom');
        $local_description=$request->input('description');
        $local_superficie=$request->input('superficie');
        //$depot->save();

        DB::insert("insert into locals (id_depot,nom,description,superficie) values('$local_Depot','$local_nom','$local_description','$local_superficie') ");
        
        
        return redirect('/home/stocks/local')->with('success','Le Local est enregistré avec succée');

    }

    public function ModifLocal(Request $request,$idLocalModif)
    {
    	$this->validate($request,[
            'nom' => 'required|max:500',
            'description' => 'required|max:1000',
            'superficie' => 'required|numeric|between:0,99.1000'
            ]);
    	/*
    	$testnom=$request->input('nom');
        $info=DB::select("select count(*) as number from depots where nom='$testnom'");
       
        $info = (array_pluck($info,'number')[0]); 

         if ($info>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de dépot existe déja  !!! ');

                return redirect()->back(); 
               }
		*/
        
        
        $local_nom=$request->input('nom');
        $local_description=$request->input('description');
        $local_superficie=$request->input('superficie');
        //$depot->save();

        
        DB::update("update locals l set nom='$local_nom',description='$local_description',superficie='$local_superficie' where l.id='$idLocalModif'  ");
        return redirect('/home/stocks/local')->with('success','Le Local a été Modifié avec succée');

    }

    public function SupprimerLocal(Request $request,$idLocalSupprimer)
    {
        
        DB::update("update locals l set visible='0' where l.id='$idLocalSupprimer'  ");

        return redirect('/home/stocks/local')->with('success','Le local a été supprimé avec succée');

    }


}
