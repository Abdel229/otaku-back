<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recuperation de tous les utilisateurs
        $users = User::all();
        //retourner les informations des utilisateurs en format json
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation des données
        $this->validate($request, [
            'name' => 'required|max:100',
            'pseudo' => 'required|max:100',
            'image' => 'required',
            'email' => 'required|email',
            'password' => 'required\min:6',
            'role' => 'required'
        ]);
        //creation d'un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'pseudo' => $request->pseudo,
            'image' => $request->image,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

    //retourner les informations de l'utilisateur en format json
    return response()->json($user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //On retourne les informations de l'utilisateur en format json
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //La validation de données
        $this->validate($request, [
            'name' => 'required|max:100',
            'pseudo' => 'required|max:100',
            'image' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);
        // Modifier les informations de l'utilisateur
        $user->update([
            'name' => $request->name,
            'pseudo' => $request->pseudo,
            'image' => $request->image,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        //retourner la réponse en format JSON
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //supprimer un utilisateur
        $user->delete();

        // retourner la reponse en JSON
        return response()->json();
    }
}
