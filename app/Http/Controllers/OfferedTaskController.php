<?php

namespace App\Http\Controllers;

use App\Models\OfferedTask;
use Illuminate\Http\Request;

class OfferedTaskController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $offeredTasks = OfferedTask::latest()->paginate(10);
        return view('offeredTasks.index', compact('offeredTasks'));
    }



    /*** update function ***/
    public function update(Request $request, $id)
    {
        $offeredTask = OfferedTask::findOrFail($id);
        $offeredTask->active = $request->active;
        $offeredTask->update();
        return redirect()->route('offeredTasks.index')->with('alert-info','تم تحديث البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy($id)
    {
        $offeredTask = OfferedTask::findOrFail($id);
        $offeredTask->delete();
        return redirect()->route('offeredTasks.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }

} //end of class
