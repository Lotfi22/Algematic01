<?php

namespace App\Http\Controllers\Lotfi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class VenteController extends Controller
{

	public function index()
	{

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

		$produits = (DB::select("select *,p.id as id from produits p where visible = 1 order by code_produit"));
		
		$articles = (DB::select("select * from articles  where visible = 1 order by nom"));

        $prix_vente_produits = DB::select("select * from prix_vente_produits where visible = 1");

        if(count($prix_vente_produits)>0)
        {

            $last_id = $prix_vente_produits[count($prix_vente_produits)-1]->id;
        }
        else
        {

            $last_id=0;
        }

		
		return view('Vente/Prix_ventes',compact('produits','articles','last_id'));


		# code...
	}

    //
}
