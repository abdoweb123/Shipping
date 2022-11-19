<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['message', 'amountMoney', 'type', 'deliveryMan_id', 'user_id'];



    // relation between Wallet && deliveryMan
    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class,'deliveryMan_id');
    }


    // relation between Wallet && user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }



} //end of class
