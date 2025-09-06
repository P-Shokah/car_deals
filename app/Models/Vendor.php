<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'full_name',
        'about',
        'phone',
        'doc_url',
        'experience',
        'pic_url',
        'user_id'
    ];


    public function user() {
        return $this->belongsTo(User::class); 
    }
    public function transactions() {
        return $this->hasMany(Transaction::class); 
    }
    public function reels() {
        return $this->hasMany(Reel::class); 
    }
    public function products() {
        return $this->hasMany(Product::class); 
    }
}
