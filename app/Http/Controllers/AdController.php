<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $ads = Ad::latest()->paginate();
        return view('ads.index', compact('ads'));
    }



    /*** store function ***/
    public function store(AdStoreRequest $request)
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

        Ad::create([
            'imageUrl'=> json_encode($images),
            'url'=> $data['url'],
            'active'=> 0,
        ]);

        return redirect()->route('ads.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(AdUpdateRequest $request, Ad $ad)
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


            foreach ($ad->imageUrl as $image)
            {
                $image_path = 'assets/images/'.$image;

                if (file_exists($image_path))
                {
                    @unlink($image_path);
                }
            }



            $ad->update([
                'imageUrl'=> json_encode($images),
                'url'=> $data['url'],
                'active'=> $data['active'],
            ]);

        }
         else{
             unset($data['image']);
             $ad->update([
                 'url'=> $data['url'],
                 'active'=> $data['active'],
             ]);
         }

        return redirect()->route('ads.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(Ad $ad)
    {

        $ad->delete();
        return redirect()->route('ads.index')->with('alert-danger','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
