<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_categorie extends Model
{
    use HasFactory;


    protected $guaded=[];
    public function event(){
        return $this->belongsToMany(event::class);
    }
}
