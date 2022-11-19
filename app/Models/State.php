<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name'];

    protected $fillable = ['name', 'imageUrl', 'numberOfOrders'];


    public function getImageUrlAttribute($imageUrl)
    {
        return json_decode($imageUrl,true);
    }


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
