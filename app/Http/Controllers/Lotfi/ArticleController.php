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


class ArticleController extends Controller
{

    public function index()
    {

        $id = Auth::id();
        $actuel = User::FindOrFail($id);

        $articles=DB::select("select * from articles where visible = 1");

        if(count($articles)>0)
        {

            $last_id = $articles[count($articles)-1]->id;
        }
        else
        {

            $last_id=0;
        }

        return view('Vente.articles',compact('articles','last_id'));

        # code...
    }

    public function ajouterarticle(Request $request)
    {

        if ($request->ajax()) 
        {
    
            (DB::insert("insert into articles(nom,description) values(\"$request->nom\",\"$request->description\")"));

            return response()->json();

            # code...
        }

    	# code...
    }

    public function modifierarticles(Request $request)
    {
    	
        if ($request->ajax()) 
        {

            (DB::update("update articles c set c.nom=\"$request->nom\",c.description=\"$request->description\" where (c.id=$request->id) "));

            return response()->json();
        }
        
        # code...
    }

    public function supprimerarticles(Request $request)
    {

        if ($request->ajax()) 
        {

            (DB::update("update articles c set c.visible=0 where (c.id=$request->id) "));

            return response()->json();

            # code...
        }

        # code...
    }



    //
}
