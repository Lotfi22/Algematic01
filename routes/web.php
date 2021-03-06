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
Route::get('/home/stocks/depot', 'Depot\DepotController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/home/stocks/AddDepot', 'Depot\DepotController@AddDepot');
/*Modification d'un  dépot*/
Route::post('/home/stocks/ModifDepot/{idDepotModif}', 'Depot\DepotController@ModifDepot');
/*Suppression d'un  dépot*/
Route::post('/home/stocks/SupprimerDepot/{idDepotSupprimer}', 'Depot\DepotController@SupprimerDepot');

/***************************** Création d'un LOCAL (CRUD)************************/
Route::get('/home/stocks/local', 'Local\LocalController@index');
/*L'ajout d'un nouveau local*/
Route::post('/home/stocks/AddLocal', 'Local\LocalController@AddLocal');
/*Modification d'un  local*/
Route::post('/home/stocks/ModifLocal/{idLocalModif}', 'Local\LocalController@ModifLocal');
/*Suppression d'un  local*/
Route::post('/home/stocks/SupprimerLocal/{idLocalSupprimer}', 'Local\LocalController@SupprimerLocal');

/***************************** Création d'un RAYON (CRUD)************************/
Route::get('/home/stocks/rayon', 'Rayon\RayonController@index');
/*L'ajout d'un nouveau rayon*/
Route::post('/home/stocks/AddRayon', 'Rayon\RayonController@AddRayon');
/*Modification d'un  rayon*/
Route::post('/home/stocks/ModifRayon/{idRayonModif}', 'Rayon\RayonController@ModifRayon');
/*Suppression d'un  rayon*/
Route::post('/home/stocks/SupprimerRayon/{idRayonSupprimer}', 'Rayon\RayonController@SupprimerRayon');

/***************************** Création d'une Etagère (CRUD)************************/
Route::get('/home/stocks/etagere', 'Etagere\EtagereController@index');
/*L'ajout d'un nouveau rayon*/
Route::post('/home/stocks/AddEtagere', 'Etagere\EtagereController@AddEtagere');
/*Modification d'un  rayon*/
Route::post('/home/stocks/ModifEtagere/{idEtagereModif}', 'Etagere\EtagereController@ModifEtagere');
/*Suppression d'un  rayon*/
Route::post('/home/stocks/SupprimerEtagere/{idEtagereSupprimer}', 'Etagere\EtagereController@SupprimerEtagere');

/***************************** Création d'un Fabricant (CRUD)************************/
Route::get('/fabricant', 'Fabricant\FabricantController@index');
/*L'ajout d'un nouveau fabricant*/
Route::post('/AddFabricant', 'Fabricant\FabricantController@AddFabricant');
/*Modification d'un  fabricant*/
Route::post('/ModifFabricant/{idFabricantModif}', 'Fabricant\FabricantController@ModifFabricant');
/*Suppression d'un  fabricant*/
Route::post('/SupprimerFabricant/{idFabricantSupprimer}', 'Fabricant\FabricantController@SupprimerFabricant');

/***************************** Création d'un Fournisseur (CRUD)************************/
Route::get('/home/fournisseurs/fournisseur', 'Fournisseur\FournisseurController@index');
/*L'ajout d'un nouveau fournisseur*/
Route::post('/commande/{idFournisseur}', 'Fournisseur\FournisseurController@commande');
/*L'ajout d'un nouveau fournisseur*/
Route::post('ADDcommande/{idFournisseur}/{numfactureproformat}','Fournisseur\FournisseurController@ADDcommande');
/*L'ajout d'un nouveau fournisseur*/
Route::post('/home/fournisseurs/AddFournisseur', 'Fournisseur\FournisseurController@AddFournisseur');
/*Modification d'un  fournisseur*/
Route::post('/home/fournisseurs/ModifFournisseur/{idFournisseurModif}', 'Fournisseur\FournisseurController@ModifFournisseur');
/*Suppression d'un  fournisseur*/
Route::post('/home/fournisseurs/SupprimerFournisseur/{idFournisseurSupprimer}', 'Fournisseur\FournisseurController@SupprimerFournisseur');


/***************************** Création d'une CatégorieProduit (CRUD)************************/
Route::get('/home/produits/categorie', 'Produit\CategorieController@index');
/*L'ajout d'un nouveau Catégorie*/
Route::post('/home/produits/AddCategorie', 'Produit\CategorieController@AddCategorie');
/*Modification d'un  Catégorie*/
Route::post('/home/produits/ModifCategorie/{idCategorieModiff}', 'Produit\CategorieController@ModifCategorie');
/*Suppression d'un  Catégorie*/
Route::post('/home/produits/SupprimerCategorie/{idCategorieSupprimer}', 'Produit\CategorieController@SupprimerCategorie');

/***************************** Création d'une Famille_Produit (CRUD)************************/
Route::get('/home/produits/familleProd', 'Produit\FamilleProduitController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/home/produits/AddFamilleProduit', 'Produit\FamilleProduitController@AddFamilleProduit');
/*Modification d'un  Famille_Produit*/
Route::post('/home/produits/ModifFamilleProduit/{idFamilleProduitModiff}', 'Produit\FamilleProduitController@ModifFamilleProduit');
/*Suppression d'un  Famille_Produit*/
Route::post('/home/produits/SupprimerFamilleProduit/{idFamilleProduitSupprimer}', 'Produit\FamilleProduitController@SupprimerFamilleProduit');

/***************************** Création d'une SOUSFamille_Produit (CRUD)************************/
Route::get('/home/produits/sousFamille', 'Produit\SousFamilleController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/home/produits/AddSousFamille', 'Produit\SousFamilleController@AddSousFamille');
/*Modification d'un  Famille_Produit*/
Route::post('/home/produits/ModifSousFamille/{idSousFamilleModiff}', 'Produit\SousFamilleController@ModifSousFamille');
/*Suppression d'un  Famille_Produit*/
Route::post('/home/produits/SupprimerSousFamille/{idSousFamilleSupprimer}', 'Produit\SousFamilleController@SupprimerSousFamille');


/***************************** Création d'une Propriété_Produit (CRUD)************************/
Route::get('/propriete', 'Produit\ProprieteController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddPropriete', 'Produit\ProprieteController@AddPropriete');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifPropriete/{idProprieteModiff}', 'Produit\ProprieteController@ModifPropriete');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerPropriete/{idProprieteSupprimer}', 'Produit\ProprieteController@SupprimerPropriete');

/***************************** Création d'une Unite (CRUD)************************/
Route::get('/home/produits/unite', 'Produit\UniteController@index');
/*L'ajout d'un nouveau Produit*/
Route::post('/home/produits/AddUnite', 'Produit\UniteController@AddUnite');
/*Modification d'un  Unite*/
Route::post('/home/produits/ModifUnite/{idUniteModiff}', 'Produit\UniteController@ModifUnite');
/*Suppression d'un  Unite*/
Route::post('/home/produits/SupprimerUnite/{idUniteSupprimer}', 'Produit\UniteController@SupprimerUnite');


/***************************** Création d'un Produits (CRUD)************************/
Route::get('/home/produits/produit', 'Produit\ProduitController@index');
/*L'ajout d'un nouveau Produit*/
Route::post('/home/produits/AddProduit', 'Produit\ProduitController@AddProduit');
/*Modification d'un  Produit*/
Route::post('/home/produits/ModifProduit/{idProduitModiff}', 'Produit\ProduitController@ModifProduit');
/*Suppression d'un  Produit*/
Route::post('/home/produits/SupprimerProduit/{idProduitSupprimer}', 'Produit\ProduitController@SupprimerProduit');

Route::get('/TelechargerProduitFicheProduit/{IdPropriete}', 'Produit\ProduitController@TelechargerProduitFicheProduit');



/***************************** Création d'une Spécifité technique_Produit (CRUD)************************/
Route::get('/technique', 'Produit\SpecifiteTechController@index');
/*L'ajout d'un nouveau Famille_Produit*/
Route::post('/AddTechnique', 'Produit\SpecifiteTechController@AddTechnique');
/*Modification d'un  Famille_Produit*/
Route::post('/ModifTechnique/{idTechniqueModiff}', 'Produit\SpecifiteTechController@ModifTechnique');
/*Suppression d'un  Famille_Produit*/
Route::post('/SupprimerTechnique/{idTechniqueSupprimer}', 'Produit\SpecifiteTechController@SupprimerTechnique');

/***************************** Achat ************************/
Route::get('/preachat', 'Achat\AchatController@index');





/***************************** Achat Bien ************************/

Route::get('/home/achats/DemandeAchat', 'DemandeAchat\DemandeAchatController@index');

Route::post('/home/achats/ADDDemandeAchat', 'DemandeAchat\DemandeAchatController@ADDDemandeAchat');

Route::get('/home/achats/DemandeAttente', 'DemandeAchat\DemandeAchatController@DemandeAttente');

Route::get('/home/achats/DemandeAttente2', 'DemandeAchat\DemandeAchatController@DemandeAttente2');

Route::post('/home/achats/RefuserDemande/{idpreachat}', 'DemandeAchat\DemandeAchatController@RefuserDemande');

Route::post('/home/achats/ValiderPreAchat/{idpreachat}', 'DemandeAchat\DemandeAchatController@ValiderPreAchat');

Route::get('/home/achats/TelechargerPiece/{IdPiece}', 'DemandeAchat\DemandeAchatController@TelechargerPiece');

Route::get('/home/achats/TelechargerProduitPhoto/{IdProduit}', 'DemandeAchat\DemandeAchatController@TelechargerProduitPhoto');

Route::get('/home/achats/TelechargerProduitFiche/{IdProduit}', 'DemandeAchat\DemandeAchatController@TelechargerProduitFiche');

Route::get('/home/achats/TelechargerProduitCaracteristique/{IdProduit}', 'DemandeAchat\DemandeAchatController@TelechargerProduitCaracteristique');

Route::get('/home/achats/TelechargerPieceAchat/{IdPiece}', 'DemandeAchat\DemandeAchatController@TelechargerPieceAchat');

Route::get('/home/achats/RangerPreAchat/{idpreachat}', 'DemandeAchat\DemandeAchatController@RangerPreAchat');


/***************************** Achat Prestation ************************/

Route::get('/home/achats/AchatArrivage', 'DemandeAchat\DemandeAchatController@AchatArrivage');

Route::get('/home/achats/Rangement', 'DemandeAchat\DemandeAchatController@Rangement');

Route::post('/home/achats/Placement/{idpreachat}/{idProduit}', 'DemandeAchat\DemandeAchatController@Placement');


/***************************** Achat Prestation ************************/

Route::get('/home/achats/DemandeAchatPrestation', 'DemandeAchat\DemandeAchatController@indexPrestation');

Route::post('/home/achats/AddDemandeAchatPrestation', 'DemandeAchat\DemandeAchatController@AddDemandeAchatPrestation');






Route::post('/home/achats/AddAchat/{idpreachat}', 'DemandeAchat\DemandeAchatController@AddAchat');

/***************************** Ranger les Produits ************************/

Route::post('/home/achats/Ranger/{idpreachat}', 'DemandeAchat\DemandeAchatController@Ranger');


/***************************** Client Walid ************************/

Route::get('/clientNimi', 'ClientNimi\ClientController@index');





/***************************** Demande_Vente ************************/

Route::get('/DemandeVente', 'DemandeVente\DemandeVenteController@index');

Route::post('/AddDemandeVente', 'DemandeVente\DemandeVenteController@AddDemandeVente');

Route::get('/DemandeVenteAttente', 'DemandeVente\DemandeVenteController@DemandeVenteAttente');

Route::post('/RefuserDemandeVente/{idPreVente}', 'DemandeVente\DemandeVenteController@RefuserDemandeVente');

Route::post('/ValiderDemandeVente/{idPreVente}', 'DemandeVente\DemandeVenteController@ValiderDemandeVente');

Route::post('/VenteFactureProformat/{idPreVente}', 'DemandeVente\DemandeVenteController@VenteFactureProformat');


/***************************** Création d'un Article de Vente (CRUD)************************/
Route::get('/article', 'DemandeVente\ArticleController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddArticle', 'DemandeVente\ArticleController@AddArticle');
/*Modification d'un  dépot*/
Route::post('/ModifArticle/{idArticleModif}', 'DemandeVente\ArticleController@ModifArticle');
/*Suppression d'un  dépot*/
Route::post('/SupprimerArticle/{idArticleSupprimer}', 'DemandeVente\ArticleController@SupprimerArticle');



/***************************** Création d'un Article de Vente (CRUD)************************/
Route::get('/article', 'DemandeVente\ArticleController@index');
/*L'ajout d'un nouveau dépot*/
Route::post('/AddArticle', 'DemandeVente\ArticleController@AddArticle');
/*Modification d'un  dépot*/
Route::post('/ModifArticle/{idArticleModif}', 'DemandeVente\ArticleController@ModifArticle');
/*Suppression d'un  dépot*/
Route::post('/SupprimerArticle/{idArticleSupprimer}', 'DemandeVente\ArticleController@SupprimerArticle');



/***************************** Produit STOCK (CRUD)************************/

Route::get('/home/stocks/ProduitStock', 'Produit\ProduitController@ProduitController');



/**********************************************Type document*****************************/

Route::get('/home/parametres/TypeDocument', 'Parametre\ParametreController@index');

/*L'ajout d'un nouveau Type Document*/
Route::post('/home/parametres/AddType', 'Parametre\ParametreController@AddType');
/*Modification d'un  Type Document*/
Route::post('/home/parametres/ModifierTypeDocument/{IdTypeModif}', 'Parametre\ParametreController@ModifierTypeDocument');
/*Suppression d'un  Type Document*/
Route::post('/home/parametres/SupprimerTypeDocument/{IdTypeSupprimer}', 'Parametre\ParametreController@SupprimerTypeDocument');


/********************************************** TVA *****************************/

Route::get('/home/parametres/tva', 'Parametre\ParametreController@indextva');
/*L'ajout d'un nouveau TVA*/
Route::post('/home/parametres/AddTVA', 'Parametre\ParametreController@AddTVA');
/*Modifier d'un  TVA*/
Route::post('/home/parametres/ModifierTVA/{IdTVAModifier}', 'Parametre\ParametreController@ModifierTVA');
/*Suppression d'un  TVA*/
Route::post('/home/parametres/SupprimerTVA/{IdTVASupprimer}', 'Parametre\ParametreController@SupprimerTVA');


/********************************************** Document *****************************/

Route::get('/home/documents/casier', 'Document\DocumentController@index');

Route::get('/home/documents/tiroir', 'Document\DocumentController@indextiroir');

Route::post('/home/documents/AddCasier', 'Document\DocumentController@AddCasier');

Route::post('/home/documents/Addtiroir', 'Document\DocumentController@Addtiroir');

Route::post('/home/documents/Modifiercasier/{idcasier}', 'Document\DocumentController@Modifiercasier');

