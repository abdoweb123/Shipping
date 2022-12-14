<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $cities = City::latest()->paginate(10);
        $countries = Country::select('id','name')->get();
        return view('cities.index', compact('cities','countries'));
    }



    /*** store function ***/
    public function store(CityRequest $request)
    {
        $city = new City();
        $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $city->active = 1;
        $city->country_id = $request->country_id;
        $city->save();

        return redirect()->route('cities.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(CityRequest $request, City $city)
    {
        $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $city->active = $request->active;
        $city->country_id = $request->country_id;
        $city->update();

        return redirect()->route('cities.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
