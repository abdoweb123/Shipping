<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\ReachedUs;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $data['users'] = User::latest()->paginate(10);
        return view('users.index', compact('data'));
    }



    /*** create function ***/
    public function create()
    {
        $data['countries'] = Country::select('id','name')->get();
        $data['nationalities'] = Nationality::select('id','name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['workingAreas'] = $data['cities'];
        $data['reachedUs'] = ReachedUs::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();

        return view('users.create', compact('data'));
    }




    /*** store function ***/
    public function store(UserStoreRequest $request)
    {

        $data = $request->all();

        if( $image = $request->file('profile_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profile_image'] = "$photo";
        }

        if( $image = $request->file('identity_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['identity_image'] = "$photo";
        }


        if( $image = $request->file('arabic_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['arabic_video_url'] = "$photo";
        }

        if( $image = $request->file('english_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['english_video_url'] = "$photo";
        }
        else{
            $data['english_video_url'] = $request['english_video_url'];
        }


        User::create([
            'full_name'=>$request['full_name'],
            'id_number'=>$request['id_number'],
            'profile_image'=>$data['profile_image'],
            'identity_image'=>$data['identity_image'],
            'nationality_id'=>$request['nationality_id'],
            'country_id'=>$request['country_id'],
            'city_id'=>$request['city_id'],
            'email'=>$request['email'],
            'area'=>$request['area'],
            'workingArea_id'=>$request['workingArea_id'],
            'specialty_id'=>$request['specialty_id'],
            'phone'=>$request['phone'],
            'relative_phone'=>$request['relative_phone'],
            'gender'=>$request['gender'],
            'birthDate'=>$request['birthDate'],
            'health_insurance'=>$request['health_insurance'],
            'antecedents'=>$request['antecedents'],
            'reachedUs_id'=>$request['reachedUs_id'],
            'arabic_video_url'=>$data['arabic_video_url'],
            'english_video_url'=>$data['english_video_url'],
            'active'=>$request['active'],
        ]);

        return redirect()->route('users.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** edit function ***/
    public function edit(User $user)
    {
        $data['countries'] = Country::select('id','name')->get();
        $data['nationalities'] = Nationality::select('id','name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['workingAreas'] = $data['cities'];
        $data['reachedUs'] = ReachedUs::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();

        return view('users.edit', compact('data','user'));
    }



    /*** show function ***/
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }



    /*** update function ***/
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();

        if( $image = $request->file('profile_image'))
        {
            $image_path = 'assets/images/'.$user->profile_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profile_image'] = "$photo";
            $user->update(['profile_image'=>$data['profile_image']]);
        }
        else{
            unset($data['profile_image']);
        }

        if( $image = $request->file('identity_image'))
        {
            $image_path = 'assets/images/'.$user->identity_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['identity_image'] = "$photo";
            $user->update(['identity_image'=>$data['identity_image']]);
        }
        else{
            unset($data['identity_image']);
        }


        if( $image = $request->file('arabic_video_url'))
        {
            $image_path = 'assets/images/'.$user->arabic_video_url;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['arabic_video_url'] = "$photo";
            $user->update(['arabic_video_url'=>$data['arabic_video_url']]);
        }
        else{
            unset($data['arabic_video_url']);
        }

        if( $image = $request->file('english_video_url'))
        {
            $image_path = 'assets/images/'.$user->english_video_url;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['english_video_url'] = "$photo";
            $user->update(['english_video_url'=>$data['english_video_url'],]);
        }
        else{
//            $data['english_video_url'] = $request['english_video_url'];
            unset($data['english_video_url']);
        }

            $user->update([
                'full_name'=>$request['full_name'],
                'id_number'=>$request['id_number'],
                'nationality_id'=>$request['nationality_id'],
                'country_id'=>$request['country_id'],
                'city_id'=>$request['city_id'],
                'email'=>$request['email'],
                'area'=>$request['area'],
                'workingArea_id'=>$request['workingArea_id'],
                'specialty_id'=>$request['specialty_id'],
                'phone'=>$request['phone'],
                'relative_phone'=>$request['relative_phone'],
                'gender'=>$request['gender'],
                'birthDate'=>$request['birthDate'],
                'health_insurance'=>$request['health_insurance'],
                'antecedents'=>$request['antecedents'],
                'reachedUs_id'=>$request['reachedUs_id'],
                'active'=>$request['active'],
            ]);

        return redirect()->route('users.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }




    /*** destroy function ***/
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('alert-success','تم حذف البيانات بنجاح');
    }

} //end of class
