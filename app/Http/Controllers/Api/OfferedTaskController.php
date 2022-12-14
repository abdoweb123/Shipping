<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\OfferedTaskRequest;
use App\Http\Resources\OfferedTaskResource;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\Offer;
use App\Models\OfferedTask;
use App\Models\User;
use Illuminate\Http\Request;

class OfferedTaskController extends Controller
{

    use CheckApi;


    /*** getAllOffers function ***/
    public function getAllOfferedTasks()
    {
        try {
            $offeredTask = OfferedTaskResource::collection(OfferedTask::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All Offered tasks',$offeredTask);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** create function ***/
    public function create(OfferedTaskRequest $request)
    {

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        $jobTask = JobTask::find($request->jobTask_id);
        if (!$jobTask){
            return $this->returnMessageError('هذه المهمة غير موجودة','404');
        }

        $offer = Offer::find($request->offer_id);
        if (!$offer){
            return $this->returnMessageError('هذا العرض غير موجودة','404');
        }

        try {
            $offeredTask = OfferedTask::create([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'jobTask_id'=>$request['jobTask_id'],
                'offer_id'=>$request['offer_id'],
                'active'=>1,
            ]);

            $getOfferedTask = OfferedTaskResource::make($offeredTask);

            return $this->returnMessageData('تم تسجيل البيانات بنجاح','200','offered task',$getOfferedTask);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** getOffer function ***/
    public function getOfferedTask($id)
    {
        $offeredTask = OfferedTask::find($id);

        if (!$offeredTask)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $getOfferedTask = OfferedTaskResource::make($offeredTask);

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','offered task',$getOfferedTask);
    }



    /*** update function ***/
    public function update(OfferedTaskRequest $request, $id)
    {
        $offeredTask = OfferedTask::find($id);

        if (!$offeredTask){
            return $this->returnMessageError('هذا العرض غير موجودة','404');
        }

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        $jobTask = JobTask::find($request->jobTask_id);
        if (!$jobTask){
            return $this->returnMessageError('هذه المهمة غير موجودة','404');
        }

        $offer = Offer::find($request->offer_id);
        if (!$offer){
            return $this->returnMessageError('هذا العرض غير موجودة','404');
        }

        try {
            $offeredTask->update([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'jobTask_id'=>$request['jobTask_id'],
                'offer_id'=>$request['offer_id'],
                'active'=>$request['active'],
            ]);

            $getOfferedTask = OfferedTaskResource::make($offeredTask);

            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','offered Task',$getOfferedTask);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** delete function ***/
    public function delete($id)
    {
        $offeredTask = OfferedTask::find($id);

        if (!$offeredTask)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $offeredTask->delete();
        return $this->returnMessageSuccess('تم حذف البيانات بنجاح','200');
    }

} //end of class
