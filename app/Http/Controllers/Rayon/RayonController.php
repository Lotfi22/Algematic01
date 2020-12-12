<?php

namespace App\Http\Controllers\Rayon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RayonController extends Controller
{
     public function index()
     {
    	$locals=DB::select("select * from locals where visible='1' ");
    	$rayons=DB::select("select * from rayons where visible='1' ");

    	return view('Rayon\rayon',compact('rayons','locals'));
     }

     public function AddRayon(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:500',
            'description' => 'required|max:800'
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
        $rayon_Local=$request->input('local');
        $rayon_nom=$request->input('nom');
        $rayon_description=$request->input('description');
        //$depot->save();

        DB::insert("insert into rayons (id_local,nom,description) values('$rayon_Local','$rayon_nom','$rayon_description') ");
        
        
        return redirect('/home/stocks/rayon')->with('success','Le Rayon est enregistré avec succée');

    }

    public function ModifRayon(Request $request,$idRayonModif)
    {
    	$this->validate($request,[
            'nom' => 'required|max:500',
            'description' => 'required|max:1000'
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
        
        
        $rayon_nom=$request->input('nom');
        $rayon_description=$request->input('description');
        //$depot->save();

        
        DB::update("update rayons r set nom='$rayon_nom',description='$rayon_description' where r.id='$idRayonModif'  ");
        return redirect('/home/stocks/rayon')->with('success','Le Rayon a été Modifié avec succée');

    }

     public function SupprimerRayon(Request $request,$idRayonSupprimer)
    {
        
        DB::update("update rayons r set visible='0' where r.id='$idRayonSupprimer'  ");
        
        return redirect('/home/stocks/rayon')->with('success','Le Rayon a été supprimé avec succée');

    }

}
