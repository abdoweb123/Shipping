<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolTypeRequest;
use App\Models\ToolType;
use Illuminate\Http\Request;

class ToolTypeController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $toolTypes = ToolType::latest()->paginate();
        return view('toolTypes.index', compact('toolTypes'));
    }



    /*** store function ***/
    public function store(ToolTypeRequest $request)
    {
        $toolType = new ToolType();
        $toolType->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $toolType->save();

        return redirect()->route('toolTypes.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(ToolTypeRequest $request, ToolType $toolType)
    {
        $toolType->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $toolType->update();

        return redirect()->route('toolTypes.index')->with('alert-info','تم تعديل البيانات بنجاح');

    }



    /*** destroy function ***/
    public function destroy(ToolType $toolType)
    {
        $toolType->delete();
        return redirect()->route('toolTypes.index')->with('alert-danger','تم نقل البيانات إلى سلة المهملات');
    }

} //end of class
