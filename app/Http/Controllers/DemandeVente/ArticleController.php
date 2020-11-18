<?php

namespace App\Http\Controllers\DemandeVente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;

class ArticleController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

     	$id = Auth::id();
        $actuel = User::FindOrFail($id);

        
    	$produits=DB::select("select p.id,p.code_produit,p.description,s.quantite,s.prix
    		from produits p, stocks s
    		where p.id=s.id_produit  ");


    	$clients=DB::select("select * from client_prospects");

    	$employes=DB::select("select * from employes");

    	$articles=DB::select("select * from articles");

    	$produit_article=DB::select("select * from prix_vente_produits p,produits d where d.id=p.id_produit");
    	
    	return view('Vente\Articles',compact('produits','clients','employes','articles','produit_article'));
     }


     public function AddArticle(Request $request)
    {
    	$this->validate($request,[
            'nom' => 'required|max:300',
            'description' => 'required|max:1000'
            ]);

    	/*
    	$testnom=$request->input('nom');
        $info=DB::select("select count(*) as number from depots where nom='$testnom'");
       
        $info = (array_pluck($info,'number')[0]); 

         if ($info>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de dépot existe déja  !!! ');

                return redirect()->back(); 
               }
		*/
        
        $nom=$request->input('nom');
        $description=$request->input('description');

        DB::insert("insert into articles (nom,description) values(\"$nom\",\"$description\")");

        $id_article=DB::select("select * from articles where nom='$nom'");

        $id_article=$id_article[0]->id;

        $total=0;

     	foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
        {
            $index = $key +1;
            $code_produit=$array['produit'];
            $id_produit=DB::select("select id  from produits where code_produit='$code_produit'");
            $id_prod=$id_produit[0]->id;
            
            $quantite=$array['quantite'];
            $prix=$array['prix'];
           
            DB::insert("insert into prix_vente_produits (id_produit,id_article,prix,quantite) 
            values('$id_prod','$id_article','$prix','$quantite') ;");
                       
            $total=$total+$array['prix']*$array['quantite'];
        }

       DB::update("update articles a set total='$total' where a.id='$id_article' ");
        
       return redirect('/article')->with('success','Article Ajouté avec succée');
    }
}
