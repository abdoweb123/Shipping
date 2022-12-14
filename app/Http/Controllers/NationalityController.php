<?php

namespace App\Http\Controllers;

use App\Http\Requests\NationalityRequest;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $nationalities = Nationality::latest()->paginate(10);
        return view('nationalities.index', compact('nationalities'));
    }



    /*** store function ***/
    public function store(NationalityRequest $request)
    {
        $nationality = new Nationality();
        $nationality->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $nationality->active = 1;
        $nationality->save();

        return redirect()->route('nationalities.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(NationalityRequest $request, Nationality $nationality)
    {
        $nationality->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $nationality->active = $request->active;
        $nationality->update();

        return redirect()->route('nationalities.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return redirect()->route('nationalities.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
