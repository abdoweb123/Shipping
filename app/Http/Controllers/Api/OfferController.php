<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\DeliveryManInfoResource;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

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
        try {
            $offer = Offer::create([
                'order_id'=>$request['order_id'],
                'deliveryMan_id'=>$request['deliveryMan_id'],
                'comment'=>$request['comment'],
                'offeredPrice'=>$request['offeredPrice'],
                'accepted'=>$request['accepted'],
            ]);
            return $this->returnMessageData('تم تسجيل البيانات بنجاح','200','offer',$offer);
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

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','offer',$offer);
    }



    /*** update function ***/
    public function update(OfferRequest $request, $id)
    {
        $offer = Offer::find($id);

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        try {
            $offer->update([
                'order_id'=>$request['order_id'],
                'deliveryMan_id'=>$request['deliveryMan_id'],
                'comment'=>$request['comment'],
                'offeredPrice'=>$request['offeredPrice'],
                'accepted'=>$request['accepted'],
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
