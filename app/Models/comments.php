<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $guaded=[];

    //fonction de liaison avec l'user
    public function user(){
        return $this->belongsTo(user::class);
    }

    //fonction de liaison avec l'user
    public function post(){
        return $this->belongsTo(post::class);
    }
}
