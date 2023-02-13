<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //

    /* fonction pour l'inscription */
    public function inscription (Request $request){

        /* insertion des données de l'utilisateur  */
        $utilisateurDonnee = $request->validate([
                "nom" => ["required", "string", "min:5", "max:255"],
                "email" => ["required", "email", "unique:users,email"],
                "password" => ["required", "string", "min:5", "max:20","confirmed"] /* password doit etre 
                                                                                        confirmé avec 
                                                                                        "confirmed"     */
        ]);
        
        /* enregistrement de l'utilisateur */
        $utilisateurs = User::create([
            
            "nom" => $utilisateurDonnee["nom"],
            "email" => $utilisateurDonnee["email"],
            "password" => bcrypt($utilisateurDonnee["password"]) /* enregistrement du password sous format crypté */

        ]);

        /* Variable permettant l'ajout du nom et de l'email dans le courrier */
        $user = [
            "nom" => $utilisateurDonnee["nom"],
            "email" => $utilisateurDonnee["email"],
        ];
        /* envoie du mail lors de l'inscription */
        Mail::to($utilisateurDonnee["email"])->send(new InscriptionMail($user));

        return response($utilisateurs,201); /* renvoi les données avec statu code post 201 */
    }

    public function connexion (Request $request){
        
        /* insertion des données de l'utilisateur pour la connexion  */
            $utilisateurDonnee = $request->validate([

                "email" => ["required", "email"],
                "password" => ["required", "string"]

                
        ]);
                /* verifi l'email et me retourne le premier */
                    $utilisateur = User::where("email", $utilisateurDonnee["email"])->first();
    
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
