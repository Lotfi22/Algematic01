<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        
        $actuel = User::FindOrFail($id);

        //$privilege=$actuel->privilege;

        $privilege = (DB::select("select privilege from users where id ='$id' ")[0]->privilege);
        
        $test=DB::select("select * from pre_achat where demande_valide ='0' ");

        $nbNonValide=count($test);
        
        return view('home',compact('actuel','privilege','nbNonValide'));
    }
}
