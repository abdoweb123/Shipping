<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Resources\AdminInfoResource;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    use CheckApi;


    /*** getAllAdmins function ***/
    public function getAllAdmins()
    {
        try {
            $admin = AdminInfoResource::collection(Admin::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All admins',$admin);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** register function ***/
    public function register(AdminRegisterRequest $request)
    {
        $admin = new AdminResource(Admin::create([

            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
        ]));

        $admin->token = auth()->guard('api-admin')->attempt($request->only(['email','password']));


        if ($admin){
            return $this->returnMessageData('تم تسجيل حساب جديد بنجاح','200','admins',$admin);
        }
        else{
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** login function ***/
    public function login(AdminLoginRequest $request)
    {
        $token = auth()->guard('api-admin')->attempt($request->only(['email','password']));

        if (!$token)
        {
            return  $this->returnMessageError('البريد الإلكتروني أو كلمة المرور غير صحيح','500');
        }

        $admin = new AdminResource(auth()->guard('api-admin')->user());
        $admin->token = $token;

        return $this->returnMessageData('تم تسجيل الدخول بنجاح','201', 'admin', $admin);
    }



    /*** getAdmin function ***/
    public function getAdmin($id)
    {
        $admin = Admin::find($id);

        if (!$admin)
        {
            return $this->returnMessageError('هذا الأدمن غير موجود','404');
        }

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','admin',$admin);
    }




    /*** update function ***/
    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin)
        {
            return $this->returnMessageError('هذا الأدمن غير موجود','404');
        }

        $admin->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
        ]);

        if ($admin)
        {
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','admin',$admin);
        }
    }



    /*** logout function ***/
    public function logout()
    {
        try {
            auth('api-admin')->logout();
            return $this->returnMessageSuccess('تم تسجيل الخروج بنجاح','201');
        }
        catch (\Exception $exception){
            return $this->returnMessageError($exception->getMessage(),'500');
        }

    }


} //end of class
