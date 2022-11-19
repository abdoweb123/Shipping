<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['user_id', 'order_id', 'comment', 'rate'];



    // relation Reviews && user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    // relation Reviews && order
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }


} //end of class
