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

        $produits=DB::select("select p.id, p.code_produit, p.description from produits p where visible =1");

    	/*$produits=DB::select("select p.id, p.code_produit, p.description, s.quantite, s.prix,s.prix_vente
        from produits p, stocks s
        where p.id=s.id_produit");*/
        
    	$clients=DB::select("select * from client_prospects");

    	$employes=DB::select("select * from employes");

    	$articles=DB::select("select * from articles where visible = 1");

    	$produit_article=DB::select("select * from prix_vente_produits p,produits d where d.id=p.id_produit");
    	
    	return view('Vente\Articles',compact('produits','clients','employes','articles','produit_article'));
    }


    public function AddArticle(Request $request)
    {   
        
    	$this->validate($request,[
            'Réferance' => 'required',
            'description_article' => 'required'
            ]);
        


        $nom=$request->input('Réferance');
        $description=$request->input('description_article');
        $Prix_propose=$request->input('Prix_propose');
        $benifice=$request->input('fayda');

        DB::insert("insert into articles (nom,description,total,benifice) values(\"$nom\",\"$description\",\"$Prix_propose\",\"$benifice\" )");

        $id_article=DB::select("select * from articles where nom='$nom'");

        $id_article=$id_article[0]->id;

     	foreach ($request['dynamic_form']['dynamic_form'] as $key=>$array) 
        {
            
            $index = $key +1;
            $code_produit=$array['produit'];
            
            $id_produit=DB::select("select id from produits where id='$code_produit'");
            $id_prod=$id_produit[0]->id;
            
            $quantite=$array['quantite'];
            
            /*$prix=$array['prix'];*/
           
            DB::insert("insert into prix_vente_produits (id_produit,id_article/*,prix*/,quantite) 
            values('$id_prod','$id_article'/*,'prix'*/,'$quantite') ;");
                       
        }
        
        return back()->with('success','Article Ajouté avec succée');
    }

    public function SupprimerArticle($id)
    {

        DB::update("update articles a set visible = 0 where a.id=\"$id\" ");

        return back()->with('warning','Article '.$id.' supprimé avec succés');

        # code...
    }

    public function getprice(Request $request)
    {

        $id = $request->id;

        $produit = (DB::select("select * from stocks where id_produit = '$id' "))[0];

        return response()->json($produit);

        # code...
    }


    //
}
