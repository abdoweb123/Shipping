<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['fromAddress', 'toAddress', 'fromLat', 'fromLong', 'toLat', 'toLong',
                           'stateFrom_id', 'stateTo_id', 'deliveryMan_id', 'description', 'price',
                           'expectedPrice', 'type', 'images', 'declined', 'accepted', 'picked',
                           'dropped', 'completed','phone', 'picDate', 'dropDate'
                          ];


    // relation between Order && offers
    public function offers()
    {
        return $this->hasMany(Offer::class,'order_id');
    }


    // relation between Order && stateFrom
    public function stateFrom()
    {
        return $this->belongsTo(State::class,'stateFrom_id');
    }


    // relation between Order && stateTo
    public function stateTo()
    {
        return $this->belongsTo(State::class,'stateTo_id');
    }


    // relation between Order && deliveryMan
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class,'deliveryMan_id');
    }


    // relation Order && reviews
    public function reviews()
    {
        return $this->hasMany(Review::class,'order_id');
    }

} //end of class
