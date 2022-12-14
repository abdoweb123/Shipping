<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Specialty extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'active'];




    /*** start relations ***/

    public function users()
    {
        return $this->hasMany(User::class,'specialty_id');
    }


    public function jobs()
    {
        return $this->hasMany(Job::class,'specialty_id');
    }

    /*** end relations ***/


} //end of class

