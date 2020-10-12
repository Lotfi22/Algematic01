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





