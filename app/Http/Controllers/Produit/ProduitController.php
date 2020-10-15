<?php

namespace App\Http\Controllers\Produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$fabricants=DB::select("select id,nom,marque from fabricants");
    	$sfamilles=DB::select("select * from sous_familles where visible=1");
    	$produits=DB::select("select * from produits where visible=1");

    	
    	return view('Produit\produit',compact('fabricants','produits','sfamilles'));
     }

}
