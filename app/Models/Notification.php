<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function reel() {
        return $this->belongsTo(Reel::class); 
    }
    public function chat() {
        return $this->belongsTo(Chat::class); 
    }
    public function user() {
        return $this->belongsTo(User::class); 
    }
}
