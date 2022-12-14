<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Job;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\CheckApi;

class OfferController extends Controller
{

    use CheckApi;


    /*** getAllOffers function ***/
    public function getAllOffers()
    {
        try {
            $offers = OfferResource::collection(Offer::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All Offers',$offers);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** create function ***/
    public function create(OfferRequest $request)
    {

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        try {
            $offer = Offer::create([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'message'=>$request['message'],
                'active'=>1,
                'accepted'=>0,
            ]);

            $getOffer = OfferResource::make($offer);

            return $this->returnMessageData('تم تسجيل البيانات بنجاح','200','offer',$getOffer);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** getOffer function ***/
    public function getOffer($id)
    {
        $offer = Offer::find($id);

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $getOffer = OfferResource::make($offer);

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','offer',$getOffer);
    }



    /*** update function ***/
    public function update(OfferRequest $request, $id)
    {
        $offer = Offer::find($id);

        if (!$offer){
            return $this->returnMessageError('هذا العرض غير موجودة','404');
        }

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        try {
            $offer->update([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'message'=>$request['message'],
                'active'=>$request['active'],
            ]);
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','offer',$offer);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** delete function ***/
    public function delete($id)
    {
        $offer = Offer::find($id);

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $offer->delete();
        return $this->returnMessageSuccess('تم حذف البيانات بنجاح','200');
    }

} //end of class
