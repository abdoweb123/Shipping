<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class DeliveryMan extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory , SoftDeletes;

    protected $fillable = ['birthdate', 'toolBackLicenceImage', 'toolFrontLicenceImage',
                            'toolType_id', 'email', 'name', 'phone', 'password' , 'nationalityFrontIdImage',
                            'nationalityBackIdImage', 'profileImage', 'state_id', 'active',
                            'working',  'type', 'lat', 'long', 'wallet'
                          ];



    // relation between DeliveryMan && toolType
    public function toolType()
    {
        return $this->belongsTo(ToolType::class,'toolType_id');
    }



    /*** Related to JWT ***/
    public function getJWTIdentifier() {
        return $this->getKey();
    }


    /*** Related to JWT ***/
    public function getJWTCustomClaims() {
        return [];
    }


    // relation between DeliveryMan && state
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }


    // relation between DeliveryMan && offers
    public function offers()
    {
        return $this->hasMany(Offer::class,'deliveryMan_id');
    }


    // relation between DeliveryMan && orders
    public function orders()
    {
        return $this->hasMany(Order::class,'deliveryMan_id');
    }


    // relation between DeliveryMan && wallets
    public function wallets()
    {
        return $this->hasMany(Wallet::class,'deliveryMan_id');
    }


} //end of class
