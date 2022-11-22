<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{

    /**
     * POST
     * URL:127.0.0.1:8000/api/register
     * @var array
     * Enregistre un utilisateur
     * Retourne une confirmation de l'enregistrement
     */
    public function register(Request $Request){
        $validate=$Request->validate([
            'name'=>'required|max:255|string',
            'pseudo'=>'required|max:255|string',
            'email'=>'string|required|unique:users',
            'password'=>'required|min:8|confirmed'
        ]);

        $user=User::create([
            'name'=>$validate['name'],
            'pseudo'=>$validate['pseudo'],
            'email'=>$validate['email'],
            'password'=>bcrypt($validate['password']),
        ]);
                //création d'une clé
                $token=$user->createToken('auth_token')->plainTextToken;


                return response()->json([
                    'status'=>True,
                    'Message'=>'Compte crée avec succcès',
                    'access_token'=>$token
                ],201);
    }

       /**
     * URL:127.0.0.1:8000/api/login
     * @var array
     * connecte un utilisateur
     * Retourne une confirmation de la connection
     */

    public function login(Request $Request){
        $validate=$Request->validate([
            'name'=>'required|max:255|string',
            'email'=>'string|required|unique:users',
            'password'=>'required|min:8'
        ]);

        $user=User::where('email',$validate['email'])->first();

        if(!$user || !Hash::check($validate['password'],$user->password)){
            return response()->json([
                'statuts'=>False,
                'message'=>'Information incompatible'
            ]);
        }

        $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>True,
            'message'=>'Connexion réussi'
        ]);
     }


      /**
     * URL:127.0.0.1:8000/api/log-out
     * @var array
     * Déconnecte un utilisateur
     * Retourne token de l'utilisateur
     */

    public function logOut(Request $Request){
        $Request->user()->tokens()->delete();
        return response()->json([
            'statut'=>True,
            'message'=>'Déconnexion réussi'
        ]);
     }

}
