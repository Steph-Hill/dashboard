<?php

namespace App\Http\Controllers;

use App\Models\Producteur;
use Illuminate\Http\Request;
use App\Mail\InscriptionMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProducteurController extends Controller
{
    //
    /* fonction pour l'inscription */
    public function inscription_producteur (Request $request){

        /* insertion des données de l'utilisateur  */
        $utilisateurDonnee = $request->validate([

                "producteur_name" => ["required", "string", "min:5", "max:255"],
                "entreprise" => ["required", "string", "min:5", "max:255"],
                "email" => ["required", "email", "unique:producteurs", "email"],
                "password" => ["required", "string", "min:5", "max:20","confirmed"] /* password doit etre 
                                                                                        confirmé avec 
                                                                                        "confirmed"     */
        ]);
        
        /* enregistrement de l'utilisateur */
        $utilisateursProducteur = Producteur::create([
            
            "producteur_name" => $utilisateurDonnee["producteur_name"],
            "entreprise" => $utilisateurDonnee["entreprise"],
            "email" => $utilisateurDonnee["email"],
            "password" => bcrypt($utilisateurDonnee["password"]) /* enregistrement du password sous format crypté */

        ]);

        if($utilisateursProducteur){

                /* Variable permettant l'ajout du nom et de l'email dans le courrier */
            $user = [
                "producteur_name" => $utilisateurDonnee["producteur_name"],
                "email" => $utilisateurDonnee["email"],
            ];

            /* envoie du mail lors de l'inscription */
                    
            Mail::to($utilisateurDonnee["email"])->send(new InscriptionMail($user));
    
            return response($utilisateursProducteur,201); /* renvoi les données avec statu code post 201 */

        }

        
    }

    public function connexion_producteur (Request $request){
        
        /* insertion des données de l'utilisateur pour la connexion  */
            $utilisateurDonnee = $request->validate([

                "email" => ["required", "email"],
                "password" => ["required", "string"]

                
        ]);
                /* verifi l'email et me retourne le premier */
                    $utilisateur = Producteur::where("email", $utilisateurDonnee["email"])->first();
    
                    /* controle si l'email corresppond bien a un utilisateur*/
                    if (!$utilisateur) {

                        return response( ["message" => "Il n'existe aucun utilisateur enregistré avec cette email : $utilisateurDonnee[email]"], 401);
                    } 
                    /*Controle du password  */
                    if (!Hash::check($utilisateurDonnee["password"], $utilisateur->password)) {
                        return response (["message" => "Aucun utilisateur trouvé avec ce mot de passe"],401);
                    }

              /* creation de mon token */      
              $token = $utilisateur->createToken('CLE_SECRETE')->plainTextToken;

              return response([

                "utilisateur" => $utilisateur,
                "token" => $token

              ], 200);

    }
}
