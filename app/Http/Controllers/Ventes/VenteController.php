<?php

namespace App\Http\Controllers\Ventes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;
use Storage;

class VenteController extends Controller
 {

	public function index()
    {

        $id = Auth::id();

        $actuel = User::FindOrFail($id);

        $privilege=$actuel->privilege;

        $articles=DB::select("select * from articles where visible =1");

        $clients=DB::select("select * from client_prospects where visible =1");

        $employes=DB::select("select *,name as nom from users");

        $ventes=DB::select(" select  *,p.id as preVente,ca.id as categorie_id, ca.nom as categorie_nom, ac.id as activite_id, ac.nom as activite_nom,u.name as nom_employe, u.prenom as prenom_employe, p.commentaire 
            
            from client_prospects c,pre_ventes p, categorie_clients ca , activite_clients ac,users u
            
            where p.id_client=c.id and c.id_categorie = ca.id and c.id_activite = ac.id and u.id=p.id_employe and p.statut_validation =2
            order by preVente asc");

        $ligne_ventes1=DB::select("select *,a.nom,a.description,l.quantite,l.total,(a.total-a.benifice) as PrixArticleAchat
            from ligne_ventes l, articles a 
            where (l.id_article=a.id)");
        
        $ligne_ventes2=DB::select("select *,a.code_produit as nom,a.description,l.quantite,l.total,l.prix_u as PrixArticleAchat
            from ligne_ventes l, produits a 
            where (l.id_produit=a.id)");
        
        foreach ($ligne_ventes2 as $value) 
        {
            $prix = (DB::select("select prix from stocks where id_produit = '$value->id_produit'"));    

            if (count($prix)>0) 
            {

                $value->PrixArticleAchat = $prix[0]->prix;       

                # code...
            }
            else
            {

                $value->PrixArticleAchat = "indispo";       
            }

            # code...
        }

        $modalities = (DB::select("select * from preventes_modalites"));
        
        $ligne_ventes = array_merge($ligne_ventes1,$ligne_ventes2);

        $pieces = DB::select("select * from type_pieces tp, pieces_preventes pp where tp.id = pp.id_piece");
        
        $type_pieces = $pieces;

        return view('Vente\DemandeValidees',compact('pieces','employes','ventes','ligne_ventes','privilege','modalities','type_pieces'));
    }

    public function get_price(Request $request)
    {

    	$montant = (DB::select("select * from pre_ventes where id = '$request->id' ")[0]);

    	return response()->json($montant);

    	# code...
    }

    //
}
