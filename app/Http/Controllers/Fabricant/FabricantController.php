<?php

namespace App\Http\Controllers\Fabricant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FabricantController extends Controller
{

    #Hada Howwa l middleware

    public function __construct()
    {
        $this->middleware('auth');
    }

	
     public function index()
     {

    	$fabricants=DB::select("select * from fabricants ");

    	
    	return view('Fabricant\fabricant',compact('fabricants'));
     }

     public function AddFabricant(Request $request)
    {	

    	
    	//dd($request->photo);

    	

    	$this->validate($request,[
            'nom' => 'required|max:300',
            'marque' => 'required|max:300',
            'description' => 'required|max:800',
            //'photo' => 'required|image|max:5000'
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

        
    	$file_extension= $request->photo->getClientOriginalExtension();
    	$file_name=time().'.'.$file_extension;
    	$path='images/fabricant';
    	$request->photo->move($path,$file_name);

        $fabricant_nom=$request->input('nom');
        $fabricant_description=$request->input('description');
        $fabricant_marque=$request->input('marque');
        $fabricant_photo=$file_name;
        //$depot->save();

        DB::insert("insert into fabricants (nom,description,photo,marque) values('$fabricant_nom','$fabricant_description','$fabricant_photo','$fabricant_marque') ");
        
        
        return redirect('/fabricant')->with('success','Le Nouveau Fabricant est enregistré avec succée');

    }
    
    public function ModifFabricant(Request $request,$idFabricantModif)
    {
    	//dd($request->photo);

    	

    	$this->validate($request,[
            'nom' => 'required|max:300',
            'marque' => 'required|max:300',
            'description' => 'required|max:800',
            //'photo' => 'required|image|max:5000'
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

        
    	$file_extension= $request->photo->getClientOriginalExtension();
    	$file_name=time().'.'.$file_extension;
    	$path='images/fabricant';
    	$request->photo->move($path,$file_name);

        $fabricant_nom=$request->input('nom');
        $fabricant_description=$request->input('description');
        $fabricant_marque=$request->input('marque');
        $fabricant_photo=$file_name;
        
        DB::update("update fabricants f set nom='$fabricant_nom',description='$fabricant_description',marque='$fabricant_marque',photo='$fabricant_photo' where f.id='$idFabricantModif'  ");
        return redirect('/fabricant')->with('success','Le fabricant a été Modifié avec succée');

    }

       public function SupprimerFabricant(Request $request,$idFabricantSupprimer)
    {
        
        DB::delete("delete from fabricants  where id='$idFabricantSupprimer'");
        return redirect('/fabricant')->with('success','Le fabricant a été supprimé avec succée');

    }

}
