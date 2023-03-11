<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;


 

    public function sections(){
        return $this->belongsTo(sections::class, 'Section_ID');
    }



    public function attendances(){
        return $this->HasMany(attendance::class);
    }



}
