<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['country_id', 'phone', 'profile_image', 'full_name', 'nationality_id',
                            'gender', 'birthDate', 'email', 'id_number', 'identity_image',
                            'relative_phone', 'city_id', 'area', 'workingArea_id', 'health_insurance',
                            'antecedents', 'reachedUs_id', 'arabic_video_url', 'english_video_url',
                            'active', 'specialty_id'
                          ];


    /*** start relations ***/

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }


    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function workingArea()
    {
        return $this->belongsTo(City::class,'workingArea_id');
    }


    public function reachedUs()
    {
        return $this->belongsTo(ReachedUs::class,'reachedUs_id');
    }


    public function specilaty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id');
    }


    public function job()
    {
        return $this->hasMany(Job::class,'user_id');
    }


    public function jobTasks()
    {
        return $this->hasMany(JobTask::class,'user_id');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class,'user_id');
    }


    public function offeredTasks()
    {
        return $this->hasMany(OfferedTask::class,'user_id');
    }

    /*** end relations ***/



} //end of class
