<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tournois extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function event_categories(){
        return $this->belongsToMany(event_categorie::class);
    }

             //relation one to many avec la table payement

             public function payement(){
        return $this->hasMany(payement::class);
            }
}
