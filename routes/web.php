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
/*L'ajout d'un nouveau local*/
Route::post('/AddLocal', 'Local\LocalController@AddLocal');
/*Modification d'un  local*/
Route::post('/ModifLocal/{idLocalModif}', 'Local\LocalController@ModifLocal');
/*Suppression d'un  local*/
Route::post('/SupprimerLocal/{idLocalSupprimer}', 'Local\LocalController@SupprimerLocal');

/***************************** Création d'un RAYON (CRUD)************************/
Route::get('/rayon', 'Rayon\RayonController@index');
/*L'ajout d'un nouveau rayon*/
Route::post('/AddRayon', 'Rayon\RayonController@AddRayon');
/*Modification d'un  rayon*/
Route::post('/ModifRayon/{idRayonModif}', 'Rayon\RayonController@ModifRayon');
/*Suppression d'un  rayon*/
Route::post('/SupprimerRayon/{idRayonSupprimer}', 'Rayon\RayonController@SupprimerRayon');

/***************************** Création d'une Etagère (CRUD)************************/
Route::get('/etagere', 'Etagere\EtagereController@index');
/*L'ajout d'un nouveau rayon*/
Route::post('/AddEtagere', 'Etagere\EtagereController@AddEtagere');
/*Modification d'un  rayon*/
Route::post('/ModifEtagere/{idEtagereModif}', 'Etagere\EtagereController@ModifEtagere');
/*Suppression d'un  rayon*/
Route::post('/SupprimerEtagere/{idEtagereSupprimer}', 'Etagere\EtagereController@SupprimerEtagere');

/***************************** Création d'un Fabricant (CRUD)************************/
Route::get('/fabricant', 'Fabricant\FabricantController@index');
/*L'ajout d'un nouveau fabricant*/
Route::post('/AddFabricant', 'Fabricant\FabricantController@AddFabricant');
/*Modification d'un  fabricant*/
Route::post('/ModifFabricant/{idFabricantModif}', 'Fabricant\FabricantController@ModifFabricant');
/*Suppression d'un  fabricant*/
Route::post('/SupprimerFabricant/{idFabricantSupprimer}', 'Fabricant\FabricantController@SupprimerFabricant');

/***************************** Création d'un Fournisseur (CRUD)************************/
Route::get('/fournisseur', 'Fournisseur\FournisseurController@index');
/*L'ajout d'un nouveau fournisseur*/
Route::post('/AddFournisseur', 'Fournisseur\FournisseurController@AddFournisseur');
/*Modification d'un  fournisseur*/
Route::post('/ModifFournisseur/{idFournisseurModif}', 'Fournisseur\FournisseurController@ModifFournisseur');
/*Suppression d'un  fournisseur*/
Route::post('/SupprimerFournisseur/{idFournisseurSupprimer}', 'Fournisseur\FournisseurController@SupprimerFournisseur');

/***************************** Création d'une CatégorieProduit (CRUD)************************/
Route::get('/categorie', 'Produit\CategorieController@index');
/*L'ajout d'un nouveau Catégorie*/
Route::post('/AddCategorie', 'Produit\CategorieController@AddCategorie');
/*Modification d'un  Catégorie*/
Route::post('/ModifCategorie/{idCategorieModiff}', 'Produit\CategorieController@ModifCategorie');
/*Suppression d'un  Catégorie*/
Route::post('/SupprimerCategorie/{idCategorieSupprimer}', 'Produit\CategorieController@SupprimerCategorie');

/***************************** Création d'une Famille_Produit (CRUD)************************/
Route::get('/familleProd', 'Produit\FamilleProduitController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddFamilleProduit', 'Produit\FamilleProduitController@AddFamilleProduit');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifFamilleProduit/{idFamilleProduitModiff}', 'Produit\FamilleProduitController@ModifFamilleProduit');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerFamilleProduit/{idFamilleProduitSupprimer}', 'Produit\FamilleProduitController@SupprimerFamilleProduit');

/***************************** Création d'une SOUSFamille_Produit (CRUD)************************/
Route::get('/sousFamille', 'Produit\SousFamilleController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddSousFamille', 'Produit\SousFamilleController@AddSousFamille');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifSousFamille/{idSousFamilleModiff}', 'Produit\SousFamilleController@ModifSousFamille');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerSousFamille/{idSousFamilleSupprimer}', 'Produit\SousFamilleController@SupprimerSousFamille');


/***************************** Création d'une Propriété_Produit (CRUD)************************/
Route::get('/propriete', 'Produit\ProprieteController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddPropriete', 'Produit\ProprieteController@AddPropriete');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifPropriete/{idProprieteModiff}', 'Produit\ProprieteController@ModifPropriete');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerPropriete/{idProprieteSupprimer}', 'Produit\ProprieteController@SupprimerPropriete');

/***************************** Création d'une Unite (CRUD)************************/
Route::get('/unite', 'Produit\UniteController@index');
/*L'ajout d'un nouveau Produit*/
Route::post('/AddUnite', 'Produit\UniteController@AddUnite');
/*Modification d'un  Unite*/
Route::post('/ModifUnite/{idUniteModiff}', 'Produit\UniteController@ModifUnite');
/*Suppression d'un  Unite*/
Route::post('/SupprimerUnite/{idUniteSupprimer}', 'Produit\UniteController@SupprimerUnite');


/***************************** Création d'un Produits (CRUD)************************/
Route::get('/produit', 'Produit\ProduitController@index');
/*L'ajout d'un nouveau Produit*/
Route::post('/AddProduit', 'Produit\ProduitController@AddProduit');
/*Modification d'un  Produit*/
Route::post('/ModifProduit/{idProduitModiff}', 'Produit\ProduitController@ModifProduit');
/*Suppression d'un  Produit*/
Route::post('/SupprimerProduit/{idProduitSupprimer}', 'Produit\ProduitController@SupprimerProduit');



/***************************** Création d'une Spécifité technique_Produit (CRUD)************************/
Route::get('/technique', 'Produit\SpecifiteTechController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddTechnique', 'Produit\SpecifiteTechController@AddTechnique');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifTechnique/{idTechniqueModiff}', 'Produit\SpecifiteTechController@ModifTechnique');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerTechnique/{idTechniqueSupprimer}', 'Produit\SpecifiteTechController@SupprimerTechnique');