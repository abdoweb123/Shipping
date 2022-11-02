<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'deliveryMan_id', 'comment', 'offeredPrice', 'accepted'];



    // relation between Offers && order
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }


    // relation between Offer && deliveryMan
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class,'deliveryMan_id');
    }


} //end of class
