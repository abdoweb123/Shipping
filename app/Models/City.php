<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'active', 'country_id'];


    /*** start relations ***/

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }


    public function companies()
    {
        return $this->hasMany(Company::class,'city_id');
    }


    public function jobs()
    {
        return $this->hasMany(Job::class,'city_id');
    }

    /*** end relations ***/


} //end of class
