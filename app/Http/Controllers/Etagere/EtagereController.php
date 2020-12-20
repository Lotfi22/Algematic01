<?php

namespace App\Http\Controllers\Etagere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtagereController extends Controller
{


    #Hada Howwa l middleware

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
     {
    	$etageres=DB::select("select * from etageres where visible=1 ");
    	$rayons=DB::select("select * from rayons ");

    	return view('Etagere\etagere',compact('rayons','etageres'));
     }

     public function AddEtagere(Request $request)
    {
    	
    	$this->validate($request,[
            'description' => 'required|max:800',
            'num_etage' => 'required|integer|min:0|max:100'
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
        $etage_rayon=$request->input('rayon');
        $etage_description=$request->input('description');
        $etage_num=$request->input('num_etage');
        //$depot->save();

        DB::insert("insert into etageres (id_rayon,num_etage,description) values('$etage_rayon','$etage_num','$etage_description') ");
        
        
        return redirect('/home/stocks/etagere')->with('success','Etagère  enregistrée avec succée');

    }

     public function ModifEtagere(Request $request,$idEtagereModif)
    {
    	$this->validate($request,[
            'description' => 'required|max:800',
            'num_etage' => 'required|integer|min:0|max:100'
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
        
        $etage_description=$request->input('description');
        $etage_num=$request->input('num_etage');

        
        DB::update("update etageres e set num_etage='$etage_num',description='$etage_description' where e.id='$idEtagereModif' ");
        return redirect('/home/stocks/etagere')->with('success','Etagère Modifiée avec succée');

    }

     public function SupprimerEtagere(Request $request,$idEtagereSupprimer)
    {
        
        DB::update("update etageres e set visible=0 where e.id='$idEtagereSupprimer' ");

        return redirect('/home/stocks/etagere')->with('success','Etagère supprimée avec succée');
    }

}
