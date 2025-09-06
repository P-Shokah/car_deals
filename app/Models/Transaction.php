<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function vendor() {
        return $this->belongsTo(Vendor::class); 
    }
    public function client() {
        return $this->belongsTo(Client::class); 
    }
    public function product() {
        return $this->belongsTo(Product::class); 
    }
    public function reviews() {
        return $this->hasMany(Review::class); 
    }
}
