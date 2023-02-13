<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* affichage des mes produits */
        $produits = Product::all();

        /* condition si aucun produit n'a été créé */
        if(count($produits) <= 0){
            return response(['message'=>'pas de produits'],200);
        }

        return response($produits,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* validation et insertion de mes données */
        $produitsDonnee = $request->validate([
            "name" => ["required", "string"],
            "image_path" =>["required", "mimes:jpeg,jpg,png", "max:4096"],
            "quantity" => ["required", "numeric", "min:2"],
            "producteur_id" => ["required", "numeric"],
            "price" => ["required", "numeric"]
        ]);

        /* je stock mon image_path dans une variable */
        $path = $request->file("image_path")->store("/public/mesimages");

        /*creation de mes produits
            Avec inscription du nom, de la quantité et de mon producteur_id */

         $newProduits = Product::create([

            "name" => $produitsDonnee["name"],
            "quantity" => $produitsDonnee["quantity"],
            "image_path" => $path,
            "producteur_id" => $produitsDonnee["producteur_id"],
            "price"=>$produitsDonnee["price"]

        ])->first(); 
        /* reponse lors de mon ajout */
        return response(["message" => "produit ajouté !"],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* recuperation d'un produits qui est lié par mon id */
       $produit = DB::table('products') /* on recherche dans la table products */

        ->join("users", "products.producteur_id", "=", "users.id") /* on join a la table user
                                                                on cible la clé etranger du produit 
                                                                on l'associe a l'id de la table user */

        ->select("products.*","products.name", "users.email", "users.nom" )/* on recupere les données dans le model user
                                                            on affiche dans les elements du model produit */

        ->where("products.id", "=", $id) /* on recherche le produit par l'id */

        ->get()->first();/* la fonction first permet de mettre les donnée sous forme de tableau simple */

        return $produit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */


    /* modification de mon produit par l'id */
    public function update(Request $request, $id)
    {
        /* validation et insertion de mes données */
        $produitsValidation = $request->validate([
            "name" => ["required", "string"],
            "image_path" =>["required", "mimes:jpeg,jpg,png", "max:4096"],
            "quantity" => ["required", "numeric", "min:2"],
            "price" => ["required", "numeric"]
        ]);

/*         var_dump($produitsValidation["producteur_id"]);
 */
        /* affiche message si aucun utilisateur n'existe */
        $monProduit = Product::find($id);

        
        /* controle si un produit existe bien dans la base de donnée */
        if(!$monProduit){
            return response(["message" => "aucun produit n'a été trouvé avec cette id $id"],404);
        } 

        /* on verifie si c'est le bon utilisateur qui a le droit de modifier */
         if($monProduit->producteur_id != $produitsValidation["producteur_id"]){

            return response(["message"=>"Acces interdite"],403);

        }; 
        /* je modifie mon produit */
       if($monProduit->update($produitsValidation)){

        return response(["message"=>"votre produit a bien été modifié"]);

       } ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /* On valide l'existence de producteur_id */
        $produitsValidation = $request->validate([

            "producteur_id" => ["required", "numeric"]

        ]);

        $monProduit = Product::find($id);

         /* controle si un produit existe bien dans la base de donnée */
         if(!$monProduit){

            return response(["message" => "aucun produit n'a été trouvé avec cette id $id"],404);
        } 

        /* on verifie si c'est le bon utilisateur qui a le droit de supprimer */
         if($monProduit->producteur_id != $produitsValidation["producteur_id"]){

            return response(["message"=>"Acces interdite"],403);

        }; 

        /* suppression de mon produit par son id */
        if($monProduit->destroy($id)){

            return response(["message" => "votre produit à été supprimé avec succes"],200);

        }
    }
}
