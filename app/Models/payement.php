<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payement extends Model
{
    use HasFactory;

   //relation avec la table user
   public function user(){
    return $this->belongsTo(User::class);
   }

   //relation avec la table user
   public function event(){
    return $this->belongsTo(event::class);
   }

   //relation morph to many
   public function payementable(){
    return $this->morphTo();
   }
}
