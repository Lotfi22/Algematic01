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

# Catégorie Client :
Route::get('/admin/client/categorie','Lotfi\ClientController@categories_index');
Route::post('/home/categories/ajouter/ajax','Lotfi\ClientController@ajoutercategories');
Route::post('/home/categories/modifier/ajax','Lotfi\ClientController@modifiercategories');
Route::post('/home/categories/supprimer/ajax','Lotfi\ClientController@supprimercategories');


# Activité Client :
Route::get('/admin/client/activite','Lotfi\ClientController@activites_index');
Route::post('/home/activites/ajouter/ajax','Lotfi\ClientController@ajouteractivites');
Route::post('/home/activites/modifier/ajax','Lotfi\ClientController@modifieractivites');
Route::post('/home/activites/supprimer/ajax','Lotfi\ClientController@supprimeractivites');


# Client :
Route::get('/home/clients','Lotfi\ClientController@index');
Route::post('/home/clients/ajouter/ajax','Lotfi\ClientController@ajouter_client');
Route::get('/home/clients/{id}','Lotfi\ClientController@modifier_client');
Route::post('/home/clients/modifier','Lotfi\ClientController@modifier_client1');
Route::post('/home/clients/modifier/ajax','Lotfi\ClientController@modifier_client2');
Route::post('/home/clients/supprimer/ajax','Lotfi\ClientController@supprimer_client');

# Prix vente produits
Route::get('/home/prix_ventes','Lotfi\VenteController@index');



# Articles :
/***************************** Création d'un Article de Vente (CRUD)************************/
Route::get('/article', 'DemandeVente\ArticleController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddArticle', 'DemandeVente\ArticleController@AddArticle');
/*Modification d'un  dépot*/
Route::post('/ModifArticle/{idArticleModif}', 'DemandeVente\ArticleController@ModifArticle');
/*Suppression d'un  dépot*/
Route::post('/SupprimerArticle/{idArticleSupprimer}', 'DemandeVente\ArticleController@SupprimerArticle');







