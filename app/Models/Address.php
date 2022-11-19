<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['address', 'user_id', 'lat', 'long'];


    // relation between Address and user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


} //end of class
