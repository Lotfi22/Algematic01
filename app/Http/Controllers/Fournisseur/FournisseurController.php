<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FournisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$fournisseurs=DB::select("select * from fournisseurs where visible=1");

    	
    	return view('Fabricant\fournisseur',compact('fournisseurs'));
     }

      public function AddFournisseur(Request $request)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'adresse' => 'required|max:800',
            'activite' => 'required|max:500',
            'tele' => 'required|regex:/(0)[0-9]{9}/',
            'fax' => 'required|regex:/(0)[0-9]{8}/',
            'mobile' => 'required|regex:/(0)[0-9]{8}/',
            'email' => 'required|email',
            'nif' => 'required|regex:/[0-9]{10}/',
            'nis' => 'required|regex:/[0-9]{10}/',
            'rc' => 'required|max:30',
            'num_art_imp' => 'required|max:30',
            ]);

    	
    	$tele=$request->input('tele');
        $info=DB::select("select * from fournisseurs where tele='$tele'");
       
        

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Cet Fournisseur  existe déja  !!! ');

                return redirect()->back(); 
               }
		else
			   {
					$fournisseur_nom=$request->input('nom');
					$fournisseur_adresse=$request->input('adresse');
					$fournisseur_activite=$request->input('activite');
					$fournisseur_tele=$request->input('tele');
					$fournisseur_fax=$request->input('fax');
					$fournisseur_mobile=$request->input('mobile');
					$fournisseur_email=$request->input('email');
					$fournisseur_nif=$request->input('nif');
					$fournisseur_nis=$request->input('nis');
					$fournisseur_rc=$request->input('rc');
					$fournisseur_num_art_imp=$request->input('num_art_imp');
			        
			        //$depot->save();

			        DB::insert("insert into fournisseurs (nom,adresse,activite,tele,fax,mobile,email,nif,nis,rc,num_art_imp) values('$$fournisseur_nom','$fournisseur_adresse','$fournisseur_activite','$fournisseur_tele','$fournisseur_fax','$fournisseur_mobile','$fournisseur_email','$fournisseur_nif','$fournisseur_nis','$fournisseur_rc','$fournisseur_num_art_imp') ");
			        
			        
			        return redirect('/fournisseur')->with('success','Le Fournisseur est enregistré avec succée');

				}
       
    }


 public function ModifFournisseur(Request $request,$idFournisseurModif)
    {
    	
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'adresse' => 'required|max:800',
            'activite' => 'required|max:500',
            'tele' => 'required|regex:/(0)[0-9]{9}/',
            'fax' => 'required|regex:/(0)[0-9]{8}/',
            'mobile' => 'required|regex:/(0)[0-9]{8}/',
            'email' => 'required|email',
            'nif' => 'required|regex:/[0-9]{10}/',
            'nis' => 'required|regex:/[0-9]{10}/',
            'rc' => 'required|max:30',
            'num_art_imp' => 'required|max:30',
            ]);

    	
    	$tele=$request->input('tele');
        $info=DB::select("select tele from fournisseurs where tele='$tele'");
       
        

         if (count($info)>1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce téléphone existe déja  !!! ');

                return redirect()->back(); 
               }
		else
			   {
					$fournisseur_nom=$request->input('nom');
					$fournisseur_adresse=$request->input('adresse');
					$fournisseur_activite=$request->input('activite');
					$fournisseur_tele=$request->input('tele');
					$fournisseur_fax=$request->input('fax');
					$fournisseur_mobile=$request->input('mobile');
					$fournisseur_email=$request->input('email');
					$fournisseur_nif=$request->input('nif');
					$fournisseur_nis=$request->input('nis');
					$fournisseur_rc=$request->input('rc');
					$fournisseur_num_art_imp=$request->input('num_art_imp');
			        
			        DB::update("update fournisseurs f set nom='$fournisseur_nom',adresse='$fournisseur_adresse',activite='$fournisseur_activite',tele='$fournisseur_tele',fax='$fournisseur_fax',mobile='$fournisseur_mobile',email='$fournisseur_email',nif='$fournisseur_nif',nis='$fournisseur_nis',rc='$fournisseur_rc',num_art_imp='$fournisseur_num_art_imp' where f.id='$idFournisseurModif'  ");

			        
			        
			        return redirect('/fournisseur')->with('success','Le Fournisseur a été Modifié avec succée');

				}
       
    }

    public function SupprimerFournisseur(Request $request,$idFournisseurSupprimer)
    {
        
        DB::update("update  fournisseurs set visible=0  where id='$idFournisseurSupprimer'");
        return redirect('/fournisseur')->with('success','Le Fournisseur a été supprimé avec succée');

    }
}
