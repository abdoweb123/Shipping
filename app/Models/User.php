<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;


    protected $fillable = ['name', 'email', 'phone', 'state_id', 'wallet', 'image', 'password'];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];



    public function getImageAttribute($image)
    {
        return json_decode($image,true);
    }



    // relation between User && state
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }


    // relation between User && wallets
    public function wallets()
    {
        return $this->hasMany(Wallet::class,'user_id');
    }


    // relation between User and Addresses
    public function Addresses()
    {
        return $this->hasMany(Address::class,'user_id');
    }


    // relation User && reviews
    public function reviews()
    {
        return $this->hasMany(Review::class,'user_id');
    }



    /*** Related to JWT ***/
    public function getJWTIdentifier() {
        return $this->getKey();
    }


    /*** Related to JWT ***/
    public function getJWTCustomClaims() {
        return [];
    }

} //end of class
