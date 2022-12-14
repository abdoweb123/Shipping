<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReachedUsRequest;
use App\Models\ReachedUs;
use Illuminate\Http\Request;

class ReachedUsController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $reachedUs = ReachedUs::latest()->paginate(10);
        return view('reachedUs.index', compact('reachedUs'));
    }



    /*** store function ***/
    public function store(ReachedUsRequest $request)
    {
        $reachedUs = new ReachedUs();
        $reachedUs->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $reachedUs->save();

        return redirect()->route('reachedUs.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(ReachedUsRequest $request)
    {
        $reachedUs = ReachedUs::findOrFail($request->id);
        $reachedUs->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $reachedUs->update();

        return redirect()->route('reachedUs.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(Request $request)
    {
        ReachedUs::findOrFail($request->id)->delete();
        return redirect()->route('reachedUs.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
