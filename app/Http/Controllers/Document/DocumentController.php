<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;


class DocumentController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    	$types=DB::select("select * from type_pieces");

    	
    	return view('Parametre\TypePiece',compact('types'));
    }
}
