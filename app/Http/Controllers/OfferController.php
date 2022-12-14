<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $offers = Offer::latest()->paginate(10);
        return view('offers.index', compact('offers'));
    }



    /*** update function ***/
    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->active = $request->active;
        $offer->accepted = $request->accepted;
        $offer->update();
        return redirect()->route('offers.index')->with('alert-info','تم تحديث البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('offers.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }



} //end of class
