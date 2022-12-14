<?php

namespace App\Http\Controllers;

use App\Http\Requests\jobRequirementRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobRequirement;
use App\Models\JobTask;
use Illuminate\Http\Request;

class JobRequirementController extends Controller
{

    /*** index function ***/
    public function index($job_id,$company_id)
    {
        $jobRequirements = JobRequirement::where('job_id',$job_id)->latest()->paginate(10);
        $companies = Company::select('id','company_name')->get();
        $jobs = Job::select('id','job_description')->get();
        return view('jobRequirements.index', compact('companies','jobs','jobRequirements','job_id','company_id'));
    }



    /*** create function ***/
    public function create($job_id,$company_id)
    {
        $jobRequirements = JobRequirement::where('job_id',$job_id)->get();
        return view('jobRequirements.create', compact('job_id','company_id','jobRequirements'));
    }



    /*** store function ***/
    public function store(jobRequirementRequest $request)
    {
        $jobRequirement = new JobRequirement();
        $jobRequirement->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $jobRequirement->job_id = $request['job_id'];
        $jobRequirement->company_id = $request['company_id'];
        $jobRequirement->active = 1;
        $jobRequirement->save();

        return redirect()->route('jobTerms.create',[$request->job_id, $request->company_id, $request->jobTask_id, $jobRequirement->id])->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(jobRequirementRequest $request, JobRequirement $jobRequirement)
    {
        $jobRequirement->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
//        $jobRequirement->job_id = $request['job_id'];
//        $jobRequirement->company_id = $request['company_id'];
        $jobRequirement->active = $request['active'];
        $jobRequirement->update();

        return redirect()->route('jobRequirements.index')->with('alert-success','تم تحديث البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(JobRequirement $jobRequirement)
    {
        $jobRequirement->delete();
        return redirect()->route('jobRequirements.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
