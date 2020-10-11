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

Route::get('/', function () 
{

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/***************************** Création d'un DEPOT (CRUD)************************/
Route::get('/depot', 'Depot\DepotController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddDepot', 'Depot\DepotController@AddDepot');
/*Modification d'un  dépot*/
Route::post('/ModifDepot/{idDepotModif}', 'Depot\DepotController@ModifDepot');
/*Suppression d'un  dépot*/
Route::post('/SupprimerDepot/{idDepotSupprimer}', 'Depot\DepotController@SupprimerDepot');

/***************************** Création d'un LOCAL (CRUD)************************/
Route::get('/local', 'Local\LocalController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddLocal', 'Local\LocalController@AddLocal');
/*Modification d'un  dépot*/
Route::post('/ModifLocal/{idLocalModif}', 'Local\LocalController@ModifLocal');
/*Suppression d'un  dépot*/
Route::post('/SupprimerLocal/{idLocalSupprimer}', 'Local\LocalController@SupprimerLocal');