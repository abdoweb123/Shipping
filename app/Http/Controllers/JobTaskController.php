<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobTaskRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTask;
use Illuminate\Http\Request;

class JobTaskController extends Controller
{

    /*** index function ***/
    public function index($job_id,$company_id)
    {
        $data['jobTasks'] = JobTask::where('job_id',$job_id)->paginate(10);
        return view('jobTasks.index', compact('data','job_id','company_id'));
    }



    /*** create function ***/
    public function create($job_id,$company_id)
    {
        $jobTasks = JobTask::where('job_id',$job_id)->get();
        return view('jobTasks.create', compact('job_id','company_id','jobTasks'));
    }




    /*** store function ***/
    public function store(JobTaskRequest $request)
    {
        $jobTask = new JobTask();
        $jobTask->job_id = $request['job_id'];
        $jobTask->company_id = $request['company_id'];
        $jobTask->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $jobTask->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
        $jobTask->user_id = null;
        $jobTask->started = false;
        $jobTask->finished =false;
        $jobTask->active = true;
        $jobTask->save();

        return redirect()->route('jobRequirements.create',[$request->job_id, $request->company_id, $jobTask->id])->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** edit function ***/
    public function edit(JobTask $jobTask)
    {
        $data['companies'] = Company::select('id','company_name')->get();
        $data['jobs'] = Job::select('id','job_description')->get();
        return view('jobTasks.edit', compact('data','jobTask'));
    }




    /*** update function ***/
    public function update(JobTaskRequest $request, JobTask $jobTask)
    {
//        $jobTask->job_id = $request['job_id'];
//        $jobTask->company_id = $request['company_id'];
        $jobTask->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $jobTask->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
        $jobTask->user_id = null;
        $jobTask->active = $request['active'];
        $jobTask->update();

        return redirect()->route('jobTasks.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }




    /*** destroy function ***/
    public function destroy(JobTask $jobTask)
    {
        $jobTask->delete();
        return redirect()->route('jobTasks.index')->with('alert-success','تم حذف البيانات بنجاح');
    }



//    /*** index function ***/
//    public function returnJobTask($job_id)
//    {
//        $data['jobTasks'] = JobTask::where('id',$jobTask_id)->paginate(10);
//        return view('jobTasks.index', compact('data','jobTask_id'));
//    }

} //end of class
