<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_categorie extends Model
{
    use HasFactory;

        //permition d'insérer des données dans la base de donné
        protected $fillable=['name'];

        //function de la relation one to many avec le model post

        public function post(){
            return $this->belongsToMany(post::class);
}
}
