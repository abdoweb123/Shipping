<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\UserInfoResource;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use CheckApi;


    /*** getAllUsers function ***/
    public function getAllUsers()
    {
        try {
            $user = UserInfoResource::collection(User::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All users',$user);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** register function ***/
    public function register(UserRegisterRequest $request)
    {
        $data = $request->all();
        $images = [];
        if ($files = $request->hasFile('image'))
        {
            $files = $request->file('image');
            foreach ($files as $file)
            {
                $name = time() . rand(1,100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/users/'),$name);
                $images[] = $name;
            }
        }

        $user = new UserResource(User::create([

            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
            'phone' => $request['phone'],
            'state_id' => $request['state_id'],
            'wallet' => $request['wallet'],
            'image'=> json_encode($images),
        ]));

        $user->token = auth()->guard('api-user')->attempt($request->only(['email','password']));


        if ($user){
            return $this->returnMessageData('تم تسجيل حساب جديد بنجاح','200','users',$user);
        }
        else{
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** login function ***/
    public function login(UserLoginRequest $request)
    {
        $token = auth()->guard('api-user')->attempt($request->only(['email','password']));

        if (!$token)
        {
            return  $this->returnMessageError('البريد الإلكتروني أو كلمة المرور غير صحيح','500');
        }

        $user = new UserResource(auth()->guard('api-user')->user());
        $user->token = $token;

        return $this->returnMessageData('تم تسجيل الدخول بنجاح','201', 'user', $user);
    }



    /*** getUser function ***/
    public function getUser($id)
    {
        $user = User::find($id);

        try {
            if (!$user)
            {
                return $this->returnMessageError('هذا العميل غير موجود','404');
            }

            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','user',$user);
        }

     catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }




    /*** update function ***/
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user)
        {
            return $this->returnMessageError('هذا العميل غير موجود','404');
        }

        $data = $request->all();
        $images = [];
        if ($files = $request->hasFile('image'))
        {
            $files = $request->file('image');
            foreach ($files as $file)
            {
                $path = 'ads/';
                $name = time() . rand(1,100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/users/'),$name);
                $images[] = $name;
                $data['image'] = json_encode($images);
            }


            foreach ($user->image as $image)
            {
                $image_path = 'assets/images/users/'.$image;

                if (file_exists($image_path))
                {
                    @unlink($image_path);
                }
            }



            $user->update([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'phone' => $request['phone'],
                'state_id' => $request['state_id'],
                'wallet' => $request['wallet'],
                'image'=> json_encode($images),
            ]);

        }
        else{
            unset($data['image']);
            $user->update([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'phone' => $request['phone'],
                'state_id' => $request['state_id'],
                'wallet' => $request['wallet'],
            ]);
        }

        if ($user)
        {
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','admin',$user);
        }
    }



    /*** logout function ***/
    public function logout()
    {
        try {
            auth('api-user')->logout();
            return $this->returnMessageSuccess('تم تسجيل الخروج بنجاح','201');
        }
        catch (\Exception $exception){
            return $this->returnMessageError($exception->getMessage(),'500');
        }
    }


} //end of class
