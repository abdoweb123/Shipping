<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'imageUrl', 'numberOfOrders'];



    // relation between State && deliveryMan
    public function deliveryMan()
    {
        return $this->hasMany(DeliveryMan::class,'state_id');
    }


    // relation between State && ordersFrom
    public function ordersFrom()
    {
        return $this->hasMany(Order::class,'stateFrom_id');
    }


    // relation between State && ordersTo
    public function ordersTo()
    {
        return $this->hasMany(Order::class,'stateTo_id');
    }


    // relation between State && users
    public function users()
    {
        return $this->hasMany(User::class,'state_id');
    }


} //end of class
