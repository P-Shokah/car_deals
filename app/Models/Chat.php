<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{   
    
    public function members() {
        return $this->hasMany(Member::class); 
    }
    public function notifications() {
        return $this->hasMany(Notification::class); 
    }
    public function messages() {
        return $this->hasMany(Message::class); 
    }
    public function users() {
        return $this->belongsToMany(Member::class, 'members')->withTimestamps();
    }
}
