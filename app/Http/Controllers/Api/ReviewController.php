<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    use CheckApi;


    /*** getAllReviews function ***/
    public function getAllReviews()
    {
        try {
            $reviews = ReviewResource::collection(Review::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All Reviews',$reviews);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** create function ***/
    public function create(ReviewRequest $request)
    {
        try {
            $review = Review::create([
                'user_id'=>$request['user_id'],
                'order_id'=>$request['order_id'],
                'comment'=>$request['comment'],
                'rate'=>$request['rate'],
            ]);
            return $this->returnMessageData('تم تسجيل البيانات بنجاح','200','review',$review);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** getReview function ***/
    public function getReview($id)
    {
        $review = Review::find($id);

        if (!$review)
        {
            return $this->returnMessageError('هذه المراجعة غير موجودة','404');
        }

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','review',$review);
    }



    /*** update function ***/
    public function update(ReviewRequest $request, $id)
    {
        $review = Review::find($id);

        if (!$review)
        {
            return $this->returnMessageError('هذه المراجعة غير موجودة','404');
        }

        try {
            $review->update([
                'user_id'=>$request['user_id'],
                'order_id'=>$request['order_id'],
                'comment'=>$request['comment'],
                'rate'=>$request['rate'],
            ]);
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','review',$review);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** delete function ***/
    public function delete($id)
    {
        $review = Review::find($id);

        if (!$review)
        {
            return $this->returnMessageError('هذه المراجعة غير موجودة','404');
        }

        $review->delete();
        return $this->returnMessageSuccess('تم حذف البيانات بنجاح','200');
    }


} //end of class
