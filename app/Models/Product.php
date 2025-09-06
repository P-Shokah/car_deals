<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id',
        'product_type',
        'brand',
        'model',
        'production_year',
        'status',
        'state',
        'price(FCFA)'
    ];
    public function transaction() {
        return $this->hasOne(Transaction::class);
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
}
