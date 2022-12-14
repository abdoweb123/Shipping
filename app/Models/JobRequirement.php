<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class JobRequirement extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'job_id', 'company_id', 'active'];




    /*** start relations ***/

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }


    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

    /*** end relations ***/


} //end of class
