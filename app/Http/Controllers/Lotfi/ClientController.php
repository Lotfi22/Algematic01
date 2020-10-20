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

        $clients = (DB::select("select * from client_prospects cl , categorie_clients ca , activite_clients ac where cl.id_categorie = ca.id and id_activite = ac.id "));
        
        $categories = DB::select("select * from categorie_clients");

        $activites = DB::select("select * from activite_clients where visible = 1") ;

        if(count($clients)>0)
        {

            $last_id = array_last($clients)->id;
        }
        else
        {

            $last_id=0;
        }

        return view('Client/clients',compact('actuel','clients','categories','last_id','activites'));

        //
    }

    public function ajouter_client(Request $request)
    {


        $this->validate($request,[

            'code' => 'required|alpha_num',
            'tel' => 'numeric',
            'fax' => 'numeric',
            'mobile' => 'numeric',
            'email' => 'email',
            'nis' => 'alpha_num',
            'nif' => 'alpha_num',
            'rc' => 'alpha_num',
            'taux_remise_spec' => 'numeric',
            'plafond_credit' => 'numeric',
            #..
        ]);

        dd("je suis f ClientController");
        #DB::insert("insert into clients (code,tel,fax,mobile,email,nis,nif,rc,taux_remise_spec,plafond_credit,type,client_inter_fact,motif_interd,id_categorie,id_activite) values ()");

        # code...
    }





    public function categories_index()
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $categories=DB::select("select * from categorie_clients where visible = 1");

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
    
            (DB::insert("insert into categorie_clients(num,nom,description) values(\"$request->num\",\"$request->nom\",\"$request->description\")"));

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

            (DB::update("update categorie_clients c set c.visible=0 where (c.id=$request->id) "));

            return response()->json();

            # code...
        }

        # code...
    }




    // Activités ....... : 




    public function activites_index()
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $activites=DB::select("select * from activite_clients where visible = 1");

        if(count($activites)>0)
        {

            $last_id = $activites[count($activites)-1]->id;
        }
        else
        {

            $last_id=0;
        }

        return view('Client.activite',compact('activites','last_id'));

        # code...
    }


    public function ajouteractivites(Request $request)
    {

        if ($request->ajax()) 
        {
    
            (DB::insert("insert into activite_clients(num,nom,description) values(\"$request->num\",\"$request->nom\",\"$request->description\")"));

            return back();

            # code...
        }

        # code...
    }    


    public function modifieractivites(Request $request)
    {

        if ($request->ajax()) 
        {

            (DB::update("update activite_clients c set c.nom=\"$request->nom\",c.description=\"$request->description\" where (c.id=$request->id) "));

            return response()->json();
        }
        
        # code...
    }

    public function supprimeractivites(Request $request)
    {

        if ($request->ajax()) 
        {

            (DB::update("update activite_clients c set c.visible=0 where (c.id=$request->id) "));

            return response()->json();

            # code...
        }

        # code...
    }


    //
}
