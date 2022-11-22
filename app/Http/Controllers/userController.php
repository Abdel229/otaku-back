<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


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
            'password'=>'required|min:8|confirmed',
            'role'=>'integer'
        ]);
        $image=$Request->image;
        //verify if the image has a good extension
        $extension=[
            'png',
            'jpeg',
            'jpg'
        ];

        if(!in_array($image->getClientOriginalExtension(),$extension)){
            return response()->json([
                'status'=>True,
                'Message'=>'Vous devez télécharger une image',
            ],200);
        // }
        //create name of image
        $filename=$image->hashName();
        //create path of image
        $path=$Request->file('image')->storeAs(
            'avatars',
            $filename,
            'public'
        );
        $user=User::create([
            'name'=>$validate['name'],
            'pseudo'=>$validate['pseudo'],
            'email'=>$validate['email'],
            'image'=>$path,
            'password'=>bcrypt($validate['password']),
            'role'=>$validate['role']
        ]);
                //création d'une clé
                $token=$user->createToken('auth_token')->plainTextToken;


                return response()->json([
                    'status'=>True,
                    'Message'=>'Compte crée avec succcès',
                    'access_token'=>$token
                ],201);
    }
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
