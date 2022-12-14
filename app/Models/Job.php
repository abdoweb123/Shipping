<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['company_id', 'city_id', 'specialization_id', 'user_id', 'latitude', 'longitude',
                           'duration_by_day', 'minimum_cost', 'maximum_cost', 'payment_type', 'job_type',
                            'job_description', 'start_time', 'end_time', 'started', 'finished', 'active'];


    /*** start relations ***/

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialization_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function jobTasks()
    {
        return $this->hasMany(JobTask::class,'job_id');
    }


    public function JobRequirements()
    {
        return $this->hasMany(JobRequirement::class,'job_id');
    }


    public function JobTerms()
    {
        return $this->hasMany(JobTerms::class,'job_id');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class,'job_id');
    }


    public function offeredTasks()
    {
        return $this->hasMany(OfferedTask::class,'job_id');
    }


    /*** end relations ***/


} //end of class
