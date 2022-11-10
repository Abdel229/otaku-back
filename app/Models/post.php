<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;


    //permition d'insérer des données dans la base de donné
    protected $fillable=['name','content'];

    //function de la relation one to many avec le model post

    public function categorie_post(){
        return $this->belongsToMany(post_categorie::class);
    }

    //function de la relation one to many avec le model post

    public function comments(){
        return $this->hasMany(comments::class);
    }
}
