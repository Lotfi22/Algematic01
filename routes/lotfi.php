<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home/produits/categorie', 'Produit\CategorieController@index');
Route::get('/home/produits/familleProd', 'Produit\FamilleProduitController@index');
Route::get('/home/produits/sousFamille', 'Produit\SousFamilleController@index');
Route::get('/home/produits/propriete', 'Produit\ProprieteController@index');
Route::get('/home/produits/unite', 'Produit\UniteController@index');
Route::get('/home/produits/produit', 'Produit\ProduitController@index');
Route::get('/home/produits/technique', 'Produit\SpecifiteTechController@index');



# Catégorie Client :
Route::get('/home/clients/categorie','Lotfi\ClientController@categories_index');
Route::post('/home/categories/ajouter/ajax','Lotfi\ClientController@ajoutercategories');
Route::post('/home/categories/modifier/ajax','Lotfi\ClientController@modifiercategories');
Route::post('/home/categories/supprimer/ajax','Lotfi\ClientController@supprimercategories');


# Activité Client :
Route::get('/home/clients/activite','Lotfi\ClientController@activites_index');
Route::post('/home/activites/ajouter/ajax','Lotfi\ClientController@ajouteractivites');
Route::post('/home/activites/modifier/ajax','Lotfi\ClientController@modifieractivites');
Route::post('/home/activites/supprimer/ajax','Lotfi\ClientController@supprimeractivites');


# Client :
Route::get('/home/clients/prospectes','Lotfi\ClientController@index');
Route::post('/home/clients/ajouter/ajax','Lotfi\ClientController@ajouter_client');
Route::get('/home/clients/{id}','Lotfi\ClientController@modifier_client');
Route::post('/home/clients/modifier','Lotfi\ClientController@modifier_client1');
Route::post('/home/clients/modifier/ajax','Lotfi\ClientController@modifier_client2');
Route::post('/home/clients/supprimer/ajax','Lotfi\ClientController@supprimer_client');

# Prix vente produits
Route::get('/home/prix_ventes','Lotfi\VenteController@index');



# Articles :
/***************************** Création d'un Article de Vente (CRUD)************************/
Route::get('/home/vente/article', 'DemandeVente\ArticleController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddArticle', 'DemandeVente\ArticleController@AddArticle');
/*Modification d'un  dépot*/
Route::post('/ModifArticle/{idArticleModif}', 'DemandeVente\ArticleController@ModifArticle');
/*Suppression d'un  dépot*/
Route::post('/Supprimerarticle/{idArticleSupprimer}', 'DemandeVente\ArticleController@SupprimerArticle');
Route::post('/home/vente/article/GetPrice','DemandeVente\ArticleController@getprice');

Route::get('/home/vente/DemandeVente', 'DemandeVente\DemandeVenteController@index');
Route::get('/home/vente/DemandeVenteAttente', 'DemandeVente\DemandeVenteController@DemandeVenteAttente');
Route::post('/home/vente/DemandeVente/GetPrice','DemandeVente\DemandeVenteController@get_price');
Route::post('/home/vente/DemandeVente/AddDemandeVente', 'DemandeVente\DemandeVenteController@AddDemandeVente');
Route::post('/home/vente/DemandeVenteAttente/RefuserDemandeVente/{idPreVente}' , 'DemandeVente\DemandeVenteController@RefuserDemandeVente');

# Ventes : 
/***************************************************************************************************/

Route::get('/home/vente/VenteConfirmed','Ventes\VenteController@index');
Route::post('/home/vente/VenteConfirmed/GetPrice','Ventes\VenteController@get_price');
Route::post('/home/vente/VenteConfirmed/AddVente','Ventes\VenteController@add_vente');
Route::post('/home/vente/VenteConfirmed/AddVente/Finalisation','Ventes\VenteController@finalisation1');
Route::get('/home/vente/VenteVentes','Ventes\VenteController@mes_ventes');

