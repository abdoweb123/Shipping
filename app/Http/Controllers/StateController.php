<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateStoreRequest;
use App\Http\Requests\StateUpdateRequest;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

     /*** index function ***/
    public function index()
    {
        $states = State::latest()->paginate();
        return view('states.index', compact('states'));
    }



     /*** store function ***/
    public function store(StateStoreRequest $request)
    {
        $data = $request->all();
        $images = [];
        if ($files = $request->hasFile('image'))
        {
            $files = $request->file('image');
            foreach ($files as $file)
            {
                $path = 'ads/';
                $name = time() . rand(1,100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images'),$name);
                $images[] = $name;
            }
        }

        $state = new State();
        $state->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $state->imageUrl = json_encode($images);
        $state->numberOfOrders = $data['numberOfOrders'];
        $state->save();

        return redirect()->route('states.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(StateUpdateRequest $request, State $state)
    {
        $data = $request->all();
        $images = [];
        if ($files = $request->hasFile('image'))
        {
            $files = $request->file('image');
            foreach ($files as $file)
            {
                $path = 'ads/';
                $name = time() . rand(1,100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images'),$name);
                $images[] = $name;
                $data['image'] = json_encode($images);
            }


            foreach ($state->imageUrl as $image)
            {
                $image_path = 'assets/images/'.$image;

                if (file_exists($image_path))
                {
                    @unlink($image_path);
                }
            }


            $state->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $state->imageUrl = json_encode($images);
            $state->numberOfOrders = $data['numberOfOrders'];
            $state->update();

        }
        else{
            unset($data['image']);
            $state->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $state->numberOfOrders = $data['numberOfOrders'];
            $state->update();
        }

        return redirect()->route('states.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



     /*** destroy function ***/
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('states.index')->with('alert-danger','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
