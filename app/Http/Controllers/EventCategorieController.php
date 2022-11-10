<?php

namespace App\Http\Controllers;

use App\Models\event_categorie;
use Illuminate\Http\Request;

class EventCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event_categorie  $event_categorie
     * @return \Illuminate\Http\Response
     */
    public function show(event_categorie $event_categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event_categorie  $event_categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event_categorie $event_categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event_categorie  $event_categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(event_categorie $event_categorie)
    {
        //
    }
}
