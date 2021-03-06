<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Depot;

class DepotController extends Controller
{

    #Hada Howwa l middleware

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$depots=DB::select("select * from depots where visible='1' ");
    	return view('stock\depot',compact('depots'));
    }


    public function AddDepot(Request $request)
    {
    	$this->validate($request,[
            'nom' => 'required|max:500',
            'adresse' => 'required|max:500',
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
        
        $depot_nom=$request->input('nom');
        $depot_adresse=$request->input('adresse');
        $depot_superficie=$request->input('superficie');
        //$depot->save();

        DB::insert("insert into depots (nom,adresse,superficie) values('$depot_nom','$depot_adresse','$depot_superficie') ");
        
        
        return redirect('/home/stocks/depot')->with('success','Le dépot est enregistré avec succée');

    }

    /*Modification d'un dépot*/
    public function ModifDepot(Request $request,$idDepotModif)
    {

       
    	$this->validate($request,[
            'nvnom' => 'required|max:500',
            'nvadresse' => 'required|max:500',
            'nvsuperficie' => 'required|numeric|between:0,99.1000'
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
        
        $depot_nom=$request->input('nvnom');
        $depot_adresse=$request->input('nvadresse');
        $depot_superficie=$request->input('nvsuperficie');
        //$depot->save();

        
        DB::update("update depots d set nom='$depot_nom',adresse='$depot_adresse',superficie='$depot_superficie' where d.id='$idDepotModif'  ");
        return redirect('/home/stocks/depot')->with('success','Le dépot a été Modifié avec succée');

    }

    public function SupprimerDepot(Request $request,$idDepotSupprimer)
    {
        DB::update("update depots d set visible='0' where d.id='$idDepotSupprimer'");
      
        return redirect('/home/stocks/depot')->with('success','Le dépot a été supprimé avec succée');

    }
}
