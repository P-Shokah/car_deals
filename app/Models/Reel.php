<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    public function like() {
        return $this->hasMany(Like::class); 
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class); 
    }
    public function notifications() {
        return $this->hasMany(Notification::class); 
    }
}
