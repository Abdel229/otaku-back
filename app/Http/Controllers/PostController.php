<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=post::all();
        return response()->json([
            'status'=>'succès',
            'posts'=>$posts
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
        //vérification des données transmis
        $validate=$request->validate([
            'name'=>'required|string',
            'content'=>'required|string',
            'categories'=>'nulled|string',
        ]);

        //Création du poste

       $post= post::create([
            'name'=>$validate['name'],
            'content'=>$validate['content'],
        ]);

        // Extraction de chaque catégorie s'il y'en a plusieurs
        $categories=explode(',',$validate['categorie']);

        //association du poste avec la catégorie
        $post->categorie_post()->attach($categories);
        return response()->json([
            'status'=>'succes',
            'message' =>'poste créer avec succès'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        $post=post::find($post)->getFirst();
        return response()->json([
            'status'=>'success',
            'post'=>$post,
            'message'=>'post récupéré avec succès'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        // récupération du poste
        $post=post::find($post)->getFirst();
        // validation des données
        $validate=$request->validate([
            'name'=>'required|string',
            'content'=>'required|string',
        ]);

        //mise à jour des données du poste
        $post= post::create([
            'name'=>$validate['name'],
            'content'=>$validate['content'],
        ]);
        // Extraction de chaque catégorie s'il y'en a plusieurs
        $categories=explode(',',$validate['categorie']);

        //association du poste avec la catégorie
        $post->categorie_post()->attach($categories);
        return response()->json([
            'status'=>'success',
            'message'=>'Mise à jour de la catégorie réussi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //récupération du poste
        $post=post::find($post)->getFirst();

        // suppression du poste
        $post->delete();
        return response()->json([
            'status'=>'succes',
            'message'=>'suppression du poste réussi'
        ]);
    }
}
