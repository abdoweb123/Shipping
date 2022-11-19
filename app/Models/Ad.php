<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['imageUrl', 'url', 'active'];

    protected $casts = ['imageUrl','array'];

//    public function setImageUrlAttribute($value)
//    {
//        $this->attributes['imageUrl'] = json_encode($value);
//    }

    public function getImageUrlAttribute($imageUrl)
    {
        return json_decode($imageUrl,true);
    }


} //end of class
