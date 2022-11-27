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
        //si l'image a été upload
        if(isset($Request->image)){
            $image=$Request->image;
            //verify if the image has a good extension
            $extension=[
                'png',
                'jpeg',
                'jpg'
            ];
            if(!in_array($image->extension(),$extension)){
                return response()->json([
                    'status'=>True,
                    'Message'=>'Vous devez télécharger une image',
                ],201);
            }
            //create name of image
            $filename=$image->hashName();
            //create path of image
            $path=$Request->file('image')->storeAs(
                'avatars',
                $filename,
                'public'
            );

            //si le role est défini
            if(isset($Request->role)){
                $user=User::create([
                    'name'=>$validate['name'],
                    'pseudo'=>$validate['pseudo'],
                    'email'=>$validate['email'],
                    'image'=>$path,
                    'password'=>bcrypt($validate['password']),
                    'role'=>$validate['role']
                ]);
            }
            else{
                $user=User::create([
                    'name'=>$validate['name'],
                    'pseudo'=>$validate['pseudo'],
                    'email'=>$validate['email'],
                    'image'=>$path,
                    'password'=>bcrypt($validate['password'])
                ]);
            }
        }else{
            // integration des données si l'image n'a pas été upload et que le role est défini
            if(isset($Request->role))
            {$user=User::create([
                'name'=>$validate['name'],
                'pseudo'=>$validate['pseudo'],
                'email'=>$validate['email'],
                'password'=>bcrypt($validate['password']),
                'role'=>$validate['role']
            ]);}
            else{
                $user=User::create([
                    'name'=>$validate['name'],
                    'pseudo'=>$validate['pseudo'],
                    'email'=>$validate['email'],
                    'password'=>bcrypt($validate['password'])
                ]);
            }
        }
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
            'email'=>'string|required',
            'password'=>'required|min:8'
        ]);

        $user=User::where('email',$validate['email'])->first();

        if(!$user || !Hash::check($validate['password'],$user->password)){
            return response()->json([
                'statuts'=>False,
                'message'=>'Information incompatible'
            ],203);
        }

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>True,
            'message'=>'Connexion réussi',
            'acces_token'=>$token
        ],200);
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

         /**
     * URL:127.0.0.1:8000/api/delete
     * @var array
     * Supprime un utilisateur
     * @return string
     */

     public function delete(User $user){
        $theUser=User::find($user)->getFirst();
        // si le token de l'utilisateur existe, suppression avant suppression du user
        if(empty($theUser->user()->tokens())){
            $theUser->user()->tokens()->delete();
        }

        //suppression de l'utilisateur
        $theUser->delete();
        return response()->json([

            'statut'=>True,
            'message'=>'suppression de l\'utilsiateur réussi'
        ]);
     }

}
