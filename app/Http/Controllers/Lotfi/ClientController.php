<?php

namespace App\Http\Controllers\Lotfi;

use App\Http\Controllers\Controller;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $clients = (DB::select("select * from client_prospects"));
        $categories = [];
        
        if(count($clients)>0)
        {

            $last_id = array_last($clients)->id;
        }
        else
        {

            $last_id=0;
        }

        return view('Client/clients',compact('actuel','clients','categories','last_id'));

        //
    }

    public function categories_index()
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $categories=DB::select("select * from categorie_clients");

        if(count($categories)>0)
        {

            $last_id = $categories[count($categories)-1]->id;
        }
        else
        {

            $last_id=0;
        }
        

        return view('Client.categorie',compact('categories','last_id'));

        # code...
    }


    public function ajoutercategories(Request $request)
    {

        if ($request->ajax()) 
        {
    
            (DB::insert("insert into categorie_clients(nom,description) values(\"$request->nom\",\"$request->description\")"));

            return back();

            # code...
        }

        # code...
    }    


    public function modifiercategories(Request $request)
    {

        if ($request->ajax()) 
        {

            (DB::update("update categorie_clients c set c.nom=\"$request->nom\",c.description=\"$request->description\" where (c.id=$request->id) "));

            return response()->json();
        }
        
        # code...
    }

    public function supprimercategories(Request $request)
    {

        if ($request->ajax()) 
        {

            DB::delete("delete from categorie_clients where id=$request->id");

            return response()->json();

            # code...
        }

        # code...
    }



    //
}
