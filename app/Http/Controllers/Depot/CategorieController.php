<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CategorieController extends Controller
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

}
