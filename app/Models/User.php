<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = ['name', 'email', 'phone', 'state_id', 'wallet', 'image', 'password'];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];


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


} //end of class
