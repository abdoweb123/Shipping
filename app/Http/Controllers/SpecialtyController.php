<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $specialties = Specialty::latest()->paginate(10);
        return view('specialties.index', compact('specialties'));
    }



    /*** store function ***/
    public function store(SpecialtyRequest $request)
    {
        $specialty = new Specialty();
        $specialty->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $specialty->active = 1;
        $specialty->save();

        return redirect()->route('specialties.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(SpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $specialty->active = $request->active;
        $specialty->update();

        return redirect()->route('specialties.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('specialties.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
