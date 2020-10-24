<?php

namespace App\Http\Controllers\Lotfi;

use App\Http\Controllers\Controller;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


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

        return view('Client/clients',compact('actuel','clients','categories','last_id','activites'));

        //
    }

    public function modifier_client($id_client)
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $client = (DB::select("select *,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom from client_prospects cl , categorie_clients ca , activite_clients ac where cl.id_categorie = ca.id and id_activite = ac.id and cl.id = \"$id_client\" "))[0];

        $categories = DB::select("select * from categorie_clients where visible = 1 order by nom");

        $activites = DB::select("select * from activite_clients where visible = 1 order by nom") ;
        
        return view('Client/modifier_client',compact('actuel','client','categories','activites')); 

        # code...
    }

    public function modifier_client1(Request $request)
    {   
        $id_client=($request->id_client);

        $this->validate($request,[

            'code' => 'required|alpha_num',
            'tel' => 'numeric',
            'fax' => 'numeric',
            'mobile' => 'numeric',
            'email' => 'email',
        ]);    

        if ($request->la_photo1!=null) 
        {

            $file1 = $request->la_photo1;
            
            $file1->move('photos_clients',time().'_'.$request->code.'_'.$file1->getClientOriginalName());
            
            $chemin1 = "photos_clients/".time().'_'.$request->code.'_'.$file1->getClientOriginalName();

            DB::update("update client_prospects set code_client = \"$request->code\",
            tel = \"$request->tel\",
            fax = \"$request->fax\",
            mobile = \"$request->mobile\", 
            email = \"$request->email\",
            photo = \"$chemin1\",
            id_categorie = \"$request->categorie\",
            id_activite = \"$request->activite\" 
            where id = \"$id_client\" ");
            
            /**/
        }    
        else
        {

            DB::update("update client_prospects set code_client = \"$request->code\",
            tel = \"$request->tel\",
            fax = \"$request->fax\",
            mobile = \"$request->mobile\", 
            email = \"$request->email\" 
            where id = \"$id_client\"");

            //
        }


        session()->flash('notification.message' , 'Client modifié avec succés');

        session()->flash('notification.type' , 'success');         

        return back();


        # code...
    }

    public function modifier_client2(Request $request)
    {

        if ($request->ajax()) 
        {


            $id_client=($request->id_client);

            $this->validate($request,[

                'taux_remise_spec' => 'numeric',
            ]);    

            if ($request->client_inter_fact=="OUI") 
            {

                DB::update("update client_prospects set NIS = \"$request->nis\",
                NIF = \"$request->nif\",
                RC = \"$request->RC\",
                n_art_imp = \"$request->n_art_imp\", 
                taux_remise_spec = \"$request->taux_remise_spec\",
                client_inter_fact = \"$request->client_inter_fact\",
                motif_interd = \"$request->motif_interd\",
                prospect = \"$request->type\"
                where id = \"$id_client\" ");
                
                /**/
            }    
            else
            {

                DB::update("update client_prospects set NIS = \"$request->nis\",
                NIF = \"$request->nif\",
                RC = \"$request->RC\",
                n_art_imp = \"$request->n_art_imp\", 
                taux_remise_spec = \"$request->taux_remise_spec\",
                client_inter_fact = \"$request->client_inter_fact\",
                motif_interd = NULL,
                prospect = \"$request->type\"
                where id = \"$id_client\" ");

                //
            }

            return response()->json();
        }
        
        # code...
    }


    public function ajouter_client(Request $request)
    {
        
        $id = Auth::id();

        $actuel = User::FindOrFail($id);       

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
        
        if ($request->la_photo1!=null) 
        {

            $file1 = $request->la_photo1;
            
            $file1->move('photos_clients',time().'_'.$request->code.'_'.$file1->getClientOriginalName());
            
            $chemin1 = "photos_clients/".time().'_'.$request->code.'_'.$file1->getClientOriginalName();

            /**/
        }    


        (DB::insert("insert into client_prospects (code_client,photo,tel,fax,mobile,email,nis,nif,rc,taux_remise_spec,plafond_credit,prospect,n_art_imp,client_inter_fact,motif_interd,id_categorie,id_activite,id_employe) values (\"$request->code\",\"$chemin1\",\"$request->tel\",\"$request->fax\",\"$request->mobile\",\"$request->email\",\"$request->nis\",\"$request->nif\",\"$request->rc\",\"$request->taux_remise_spec\",\"$request->plafond_credit\",\"$request->type\",\"$request->n_art_imp\",\"$request->client_inter_fact\",\"$request->motif_interd\",\"$request->categorie\",\"$request->activite\",\"$id\")"));


        session()->flash('notification.message' , 'Client ajouté avec succés');

        session()->flash('notification.type' , 'success');         

        return back();


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
