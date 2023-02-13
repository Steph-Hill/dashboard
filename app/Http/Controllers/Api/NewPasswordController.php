<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;

class NewPasswordController extends Controller
{
    /* Permet de recevoir un mail pour demande de mot oublié */
    public function forgotPassword(Request $request)
    {
        /* champ requis pour l'envoie du reset */
        $request->validate([
            'email' => 'required|email',
        ]);

        /* envoie du lien par mail */
        $status = Password::sendResetLink(
            $request->only('email')
        );


        /* verification si le lien est envoyer avec succes */
        if ($status == Password::RESET_LINK_SENT) {
            return response(["message" => "Vous avez recu un mail avec Succes ! merci de vérifier votre boite mail !"]);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /* reset password */
   public function reset(Request $request)
    {
        /* Verification de mes données */
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);
        
        /* application a apporter pour modification du mot de passe */
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),  /* champs demandé pour refaire le mot de passe */

            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                /* suppression de l'ancien token */
                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );
        /* controle si le mot de passe a bien été reinitialisé  */
        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    } 
}
