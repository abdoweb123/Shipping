<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = ['job_id', 'user_id', 'message', 'active', 'accepted'];




    /*** start relations ***/

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
        return $this->hasMany(OfferedTask::class,'offer_id');
    }

    /*** end relations ***/

} //end of class
