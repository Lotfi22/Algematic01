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
               
        $type_pieces = DB::select("select * from type_pieces tp");

        return view('Vente\DemandeValidees',compact('pieces','employes','ventes','ligne_ventes','privilege','modalities','type_pieces'));
    }

    public function get_price(Request $request)
    {

    	$montant = (DB::select("select *,montant*1 as montant_H_T,montant*1.19 as montant from pre_ventes where id = '$request->id' ")[0]);

    	return response()->json($montant);

    	# code...
    }

    public function add_vente(Request $request)
    {

    	$ventes = (DB::select("select * from ventes order by id desc"));

    	if (count($ventes) == 0) 
    	{

    		$last_id = 1;

    		# code...
    	}
    	else
    	{

			$last_id = $ventes[0]->id;    		

    		//
    	}
		
		$ligne_ventes =[];

     	foreach ($request['dynamic_form2']['dynamic_form2'] as $key=>$array)
        {
        	
        	$id_prevente = $array['la_prevente'];

        	DB::update("update pre_ventes set id_vente = '$last_id' where id = '$id_prevente' ");

	        $ligne_ventes1=DB::select("select *,a.nom,a.description,l.quantite,l.total,(a.total-a.benifice) as PrixArticleAchat
	            from ligne_ventes l, articles a 
	            where (l.id_article=a.id and l.id_pre_vente = '$id_prevente' )");
	        
	        $ligne_ventes2=DB::select("select *,a.code_produit as nom,a.description,l.quantite,l.total,l.prix_u as PrixArticleAchat
	            from ligne_ventes l, produits a 
	            where (l.id_produit=a.id and l.id_pre_vente = '$id_prevente' )");

        	$ligne_ventes = array_merge($ligne_ventes,$ligne_ventes1,$ligne_ventes2);
	        
	        //
        }

        $le_montant=(DB::select("select sum(montant) as montant_total from pre_ventes where id_vente = '$last_id' ")[0]);
        
        DB::insert("insert into ventes(montant_total) values('$le_montant->montant_total')");

        if ($request->existe_doc == "OUI") 
        {
   
            foreach ($request['dynamic_form3']['dynamic_form3'] as $key=>$array) 
            {
                
                $type_piece = ($array['type_doc']);
                
                $file1 = $array['document'];
                
                $file1->move('documents_ventes','Vente_'.$last_id.'_'.time().'_'.$file1->getClientOriginalName());
                
                $chemin1 = "documents_ventes/".'Vente_'.$last_id.'_'.time().'_'.$file1->getClientOriginalName();

                DB::insert("insert into pieces_ventes (id_vente,id_piece,chemin_piece) 
                values ('$last_id','$type_piece','$chemin1') ");
            }        
   
            # code...
        }

        $ma_vente = (DB::select("select * from ventes where id = '$last_id' "));

        $dates_dem = DB::select("select max(date_demande) as date_fin from pre_ventes where id_vente = '$last_id' ");
        
        $dates_dem = $dates_dem[0]->date_fin;

        $dates_fin = DB::select("select max(date_echue) as date_fin from pre_ventes where id_vente = '$last_id' ");
        
        $dates_fin = $dates_fin[0]->date_fin;
        
        $pieces_jointes = DB::select("select * from pieces_ventes where id_vente = '$last_id'"); 

        $client = DB::select("select * from client_prospects where id = (select max(id_client) from pre_ventes where id_vente = '$last_id')");
        
        $client=$client[0];

        $tout = $request->all();
        
        return view('Vente\DetailsVente',compact('ligne_ventes','le_montant','ma_vente','pieces_jointes','dates_dem','dates_fin','client','tout'));

    	//DB::update("");

    	# code...
    }


    //
}
