<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;

class PreAchatController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$fournisseurs=DB::select("select id,nom,marque from fournisseurs where visible=1");
    	$produits=DB::select("select p.id,p.code_produit,p.description,p.photo,p.model,p.id_unite,u.description as UniteDescription,p.id_fabricant,f.nom as NomFabricant,p.id_sous_famille,s.nom as NomFamille
             from produits p,unites u, fabricants f,sous_familles s 
            where p.id_unite=u.id and p.id_sous_famille=s.id and p.id_fabricant=f.id and p.visible=1");

    	
    	return view('Produit\preachat',compact('fournisseurs','produits'));
     }

}
