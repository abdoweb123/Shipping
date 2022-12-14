<?php

namespace App\Http\Controllers;

use App\Http\Requests\jobTermRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTerms;
use Illuminate\Http\Request;

class JobTermsController extends Controller
{

    /*** index function ***/
    public function index($job_id,$company_id)
    {
        $jobTerms = JobTerms::where('job_id',$job_id)->latest()->paginate(10);
        $companies = Company::select('id','company_name')->get();
        $jobs = Job::select('id','job_description')->get();
        return view('jobTerms.index', compact('companies','jobs','jobTerms','job_id','company_id'));
    }



    /*** create function ***/
    public function create($job_id,$company_id)
    {
        $jobTerms = JobTerms::where('job_id',$job_id)->get();
        return view('jobTerms.create', compact('job_id','company_id','jobTerms'));
    }





    /*** store function ***/
    public function store(jobTermRequest $request)
    {
        $jobTerm = new JobTerms();
        $jobTerm->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $jobTerm->job_id = $request['job_id'];
        $jobTerm->company_id = $request['company_id'];
        $jobTerm->active = 1;
        $jobTerm->save();

        return redirect()->route('jobs.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(jobTermRequest $request, JobTerms $jobTerm)
    {
        $jobTerm->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
//        $jobTerm->job_id = $request['job_id'];
//        $jobTerm->company_id = $request['company_id'];
        $jobTerm->active = $request['active'];
        $jobTerm->update();

        return redirect()->route('jobTerms.index')->with('alert-success','تم تحديث البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(JobTerms $jobTerm)
    {
        $jobTerm->delete();
        return redirect()->route('jobTerms.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
