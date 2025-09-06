<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'pic_url',
        'user_id'
    ];


    public function user() {
        return $this->belongsTo(User::class); 
    }
    public function transactions() {
        return $this->hasMany(Transaction::class); 
    }
    public function products() {
        return $this->hasManyThrough(Product::class, Transaction::class); 
    }
}
