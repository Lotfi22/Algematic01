<?php

namespace App\Http\Controllers\Fabricant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FabricantController extends Controller
{
     public function index()
     {
    	$fabricants=DB::select("select * from fabricants ");
    	
    	return view('Fabricant\fabricant',compact('fabricants'));
     }
}
