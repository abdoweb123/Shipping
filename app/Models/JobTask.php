<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class JobTask extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = ['job_id', 'company_id', 'user_id', 'name', 'description', 'started', 'finished', 'active'];




    /*** start relations ***/

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }


    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function offeredTasks()
    {
        return $this->hasMany(OfferedTask::class,'jobTask_id');
    }

    /*** end relations ***/



} //end of class
