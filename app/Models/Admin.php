<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory , SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];


   /*** Related to JWT ***/
    public function getJWTIdentifier() {
        return $this->getKey();
    }


    /*** Related to JWT ***/
    public function getJWTCustomClaims() {
        return [];
    }

} //end of class
