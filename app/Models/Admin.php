<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'Role',
        'Full_name',
        'Password',
        'Email',
    ];
    public function sections(){
        return $this->HasMany(sections::class);
    }

    protected $hidden = [
        'Password',
        'remember_token',
    ];

}


