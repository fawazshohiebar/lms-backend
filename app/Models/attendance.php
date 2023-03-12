<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class attendance extends Model
{
    use HasFactory;


    public function student(){
        return $this->belongsTo(student::class, 'Students_ID');
    }





}