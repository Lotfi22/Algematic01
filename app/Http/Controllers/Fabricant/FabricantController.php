<?php

namespace App\Http\Controllers\Fabricant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
