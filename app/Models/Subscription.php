<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function payment() {
        return $this->hasOne(Payment::class); 
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class); 
    }
}
