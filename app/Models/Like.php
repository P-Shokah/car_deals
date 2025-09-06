<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function reel() {
        return $this->belongsTo(Reel::class); 
    }
    public function user() {
        return $this->belongsTo(User::class); 
    }
}
