<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    use HasFactory;


    public function classes(){
        return $this->belongsTo(classes::class);
    }
    
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function courses(){
        return $this->hasMany(courses::class);
    }
         public function student(){
        return $this->HasMany(student::class);
    }

}
