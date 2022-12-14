<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['company_name'];

    protected $fillable = ['company_name', 'company_email', 'company_phone', 'city_id', 'pre_fullName',
                            'pre_email', 'pre_image', 'commercialRecord_image', 'licence_image', 'active',
                            'pre_agent_image', 'national_address', 'services', 'jobs', 'contract_image',
                            'logo_image', 'cover_image'];




    /*** start relations ***/

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function jobs()
    {
        return $this->hasMany(Job::class,'company_id');
    }


    public function jobTasks()
    {
        return $this->hasMany(JobTask::class,'company_id');
    }


    public function JobRequirements()
    {
        return $this->hasMany(JobRequirement::class,'company_id');
    }


    public function JobTerms()
    {
        return $this->hasMany(JobTerms::class,'company_id');
    }

    /*** end relations ***/


} //end of class
