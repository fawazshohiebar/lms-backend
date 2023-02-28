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
    
    public function Admin(){
        return $this->belongsTo(Admin::class);
    }
    public function courses(){
        return $this->hasMany(courses::class);
    }
         public function student(){
        return $this->HasMany(student::class);
    }

}
