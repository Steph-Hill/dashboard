<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CommercantController;
use App\Http\Controllers\ProducteurController;
use App\Http\Controllers\Api\NewPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Creation de l'inscription et de la connexion Producteur de mon API */
Route::post("utilisateur/inscription-producteur", [ProducteurController::class,"inscription_producteur"]);

Route::post("utilisateur/connexion-producteur", [ProducteurController::class,"connexion_producteur"]);

/* Creation de l'inscription et de la connexion Commercant de mon API */

Route::post("utilisateur/inscription-commercant", [CommercantController::class,"inscription_commercant"]);

Route::post("utilisateur/connexion-commercant", [CommercantController::class,"connexion_commercant"]);
 


/* creation du crud de mon API */

/* liste mes produits */
Route::get("/products",[ProductsController::class,"index"]);


/* autorisation d'acces aux pages si connection validé */
Route::group(["middleware" => ["auth:sanctum"]], function(){

    /* cree mes produits */
    Route::post("/products",[ProductsController::class,"store"]);
    /* cible un produits */
    Route::get("/products/{id}",[ProductsController::class,"show"]);
    /* modification de mon produit */
    Route::put("/products/{id}",[ProductsController::class,"update"]);
    /* suppression d'un produit */
    Route::delete("/products/{id}",[ProductsController::class,"destroy"]);
    
});

/* Password forgot ans reset */

Route::post("/forgoto-password", [NewPasswordController::class,"forgotPassword"]);

Route::post("/reset-password", [NewPasswordController::class,"reset"]);

