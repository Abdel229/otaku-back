<?php

namespace App\Http\Controllers;

use App\Models\post_categorie;
use Illuminate\Http\Request;

class PostCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=post_categorie::all();
        return response()->json([
            'status'=>'succes',
            'categories'=>$categories,
            'message'=>'categories récupéré avec succès'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'content'=>'string|required'
        ]);

        $post=post_categorie::create([
            'content'=>$validate['content']
        ]);

        return response()->json([
            'status'=>'succes',
            'message'=>'poste créer avec succès'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post_categorie  $post_categorie
     * @return \Illuminate\Http\Response
     */
    public function show(post_categorie $post_categorie)
    {
        $categorie=post_categorie::find($post_categorie)->getFirst();
        return response()->json([
            'status'=>'succes',
            'categorie'=>$categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post_categorie  $post_categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post_categorie $post_categorie)
    {
        $categorie=post_categorie::find($post_categorie)->getFirst();

        //vérification des données
        $validate=$request->validate([
            'content'=>'string|required'
        ]);
        // insertion des données
        $categorie::update([
            'content'=>$validate['content']
        ]);
        return response()->json([
            'status'=>'succes',
            'message'=>'mise à jour réussi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post_categorie  $post_categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(post_categorie $post_categorie)
    {
        $categorie=post_categorie::find($post_categorie)->getFirst();
        $categorie->delete();
        return response()->json([
            'status' => 'success',
            'message'=>'suppression des messages réussi'
        ]);
    }
}
