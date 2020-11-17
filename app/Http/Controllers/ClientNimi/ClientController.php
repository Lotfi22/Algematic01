<?php

namespace App\Http\Controllers\ClientNimi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;

class ClientController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
     {

     	
     	$id = Auth::id();
        $actuel = User::FindOrFail($id);

        $clients = (DB::select("select *,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom from client_prospects cl , categorie_clients ca , activite_clients ac where cl.id_categorie = ca.id and id_activite = ac.id "));
        
        $categories = DB::select("select * from categorie_clients where visible = 1");

        $activites = DB::select("select * from activite_clients where visible = 1") ;

        if(count($clients)>0)
        {

            $last_id = $clients[count($clients)-1]->id;
        }
        else
        {

            $last_id=0;
        }

        return view('Client/clientNimi',compact('actuel','clients','categories','last_id','activites'));

        

    	
    	
     }
    
}
