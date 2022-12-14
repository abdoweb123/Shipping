<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferedTask extends Model
{
    use HasFactory  ,SoftDeletes;

    protected $fillable = ['job_id', 'user_id', 'jobTask_id', 'offer_id', 'active'];




    /*** start relations ***/

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function jobTask()
    {
        return $this->belongsTo(JobTask::class,'jobTask_id');
    }


    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }


    /*** end relations ***/

} //end of class
