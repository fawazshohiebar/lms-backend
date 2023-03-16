<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model

{
    use HasFactory;
    protected $fillable = [
          
            'Class_Name',
    ];

    public function sections(){
        return $this->HasMany(sections::class);
    }
    

}
