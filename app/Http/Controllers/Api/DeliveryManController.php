<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CheckApi;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\DeliveryManLoginRequest;
use App\Http\Requests\DeliveryManRegisterRequest;
use App\Http\Requests\DeliveryManUpdateRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\DeliveryManInfoResource;
use App\Http\Resources\DeliveryManResource;
use App\Http\Resources\UserInfoResource;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class DeliveryManController extends Controller
{
    use CheckApi;


    /*** getAllUsers function ***/
    public function getAllDeliveryMen()
    {
        try {
            $DeliveryMen = DeliveryManInfoResource::collection(DeliveryMan::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All DeliveryMen',$DeliveryMen);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** register function ***/
    public function register(DeliveryManRegisterRequest $request)
    {
        $data = $request->all();

        // toolBackLicenceImage
        if( $image = $request->file('toolBackLicenceImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['toolBackLicenceImage'] = "$photo";
        }

        // toolFrontLicenceImage
        if( $image = $request->file('toolFrontLicenceImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['toolFrontLicenceImage'] = "$photo";
        }

        // nationalityFrontIdImage
        if( $image = $request->file('nationalityFrontIdImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['nationalityFrontIdImage'] = "$photo";
        }

        // nationalityBackIdImage
        if( $image = $request->file('nationalityBackIdImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['nationalityBackIdImage'] = "$photo";
        }

        // profileImage
        if( $image = $request->file('profileImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profileImage'] = "$photo";
        }


        $deliveryMan = new DeliveryManResource(DeliveryMan::create([

            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'phone' => $data['phone'],
            'state_id' => $data['state_id'],
            'wallet' => $data['wallet'],
            'birthdate'=>$data['birthdate'],
            'toolBackLicenceImage'=>$data['toolBackLicenceImage'],
            'toolFrontLicenceImage'=>$data['toolFrontLicenceImage'],
            'toolType_id'=>$data['toolType_id'],
            'nationalityFrontIdImage'=>$data['nationalityFrontIdImage'],
            'nationalityBackIdImage'=>$data['nationalityBackIdImage'],
            'profileImage'=>$data['profileImage'],
            'active'=>$data['active'],
            'working'=>$data['working'],
            'type' =>$data['type' ],
            'lat'=>$data['lat'],
            'long'=>$data['long'],

        ]));

        $deliveryMan->token = auth()->guard('api-deliveryMan')->attempt($request->only(['email','password']));


        if ($deliveryMan){
            return $this->returnMessageData('تم تسجيل حساب جديد بنجاح','200','deliveryMen',$deliveryMan);
        }
        else{
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** login function ***/
    public function login(DeliveryManLoginRequest $request)
    {
        $token = auth()->guard('api-deliveryMan')->attempt($request->only(['email','password']));

        if (!$token)
        {
            return  $this->returnMessageError('البريد الإلكتروني أو كلمة المرور غير صحيح','500');
        }

        $deliveryMan = new DeliveryManResource(auth()->guard('api-deliveryMan')->user());
        $deliveryMan->token = $token;

        return $this->returnMessageData('تم تسجيل الدخول بنجاح','201', 'deliveryMan', $deliveryMan);
    }



    /*** getUser function ***/
    public function getDeliveryMan($id)
    {
        $deliveryMan = DeliveryMan::find($id);

        if (!$deliveryMan)
        {
            return $this->returnMessageError('هذا السائق غير موجود','404');
        }

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','deliveryMan',$deliveryMan);
    }




    /*** update function ***/
    public function update(DeliveryManUpdateRequest $request, $id)
    {
        $deliveryMan = DeliveryMan::find($id);

        if (!$deliveryMan)
        {
            return $this->returnMessageError('هذا السائق غير موجود','404');
        }

        $data = $request->all();

        // toolBackLicenceImage
        if( $image = $request->file('toolBackLicenceImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['toolBackLicenceImage'] = "$photo";


            $image_path = 'assets/images/DeliveryMen/'.$deliveryMan->toolBackLicenceImage;

            if (file_exists($image_path))
            {
                @unlink($image_path);
            }
        }

        // toolFrontLicenceImage
        if( $image = $request->file('toolFrontLicenceImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['toolFrontLicenceImage'] = "$photo";

            $image_path = 'assets/images/DeliveryMen/'.$deliveryMan->toolFrontLicenceImage;

            if (file_exists($image_path))
            {
                @unlink($image_path);
            }
        }

        // nationalityFrontIdImage
        if( $image = $request->file('nationalityFrontIdImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['nationalityFrontIdImage'] = "$photo";

            $image_path = 'assets/images/DeliveryMen/'.$deliveryMan->nationalityFrontIdImage;

            if (file_exists($image_path))
            {
                @unlink($image_path);
            }
        }

        // nationalityBackIdImage
        if( $image = $request->file('nationalityBackIdImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['nationalityBackIdImage'] = "$photo";

            $image_path = 'assets/images/DeliveryMen/'.$deliveryMan->nationalityBackIdImage;

            if (file_exists($image_path))
            {
                @unlink($image_path);
            }
        }

        // profileImage
        if( $image = $request->file('profileImage'))
        {
            $path = 'assets/images/DeliveryMen/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profileImage'] = "$photo";

            $image_path = 'assets/images/DeliveryMen/'.$deliveryMan->profileImage;

            if (file_exists($image_path))
            {
                @unlink($image_path);
            }
        }

        if( !$request->file('toolBackLicenceImage') ||
            !$request->file('toolFrontLicenceImage') ||
            !$request->file('nationalityFrontIdImage') ||
            !$request->file('nationalityBackIdImage') ||
            !$request->file('profileImage')
        ){
            unset($data['toolBackLicenceImage']);
            unset($data['toolFrontLicenceImage']);
            unset($data['nationalityFrontIdImage']);
            unset($data['nationalityBackIdImage']);
            unset($data['profileImage']);
            $deliveryMan->update([$data]);
        }else{
            $deliveryMan->update([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),
                'phone' => $data['phone'],
                'state_id' => $data['state_id'],
                'wallet' => $data['wallet'],
                'birthdate'=>$data['birthdate'],
                'toolBackLicenceImage'=>$data['toolBackLicenceImage'],
                'toolFrontLicenceImage'=>$data['toolFrontLicenceImage'],
                'toolType_id'=>$data['toolType_id'],
                'nationalityFrontIdImage'=>$data['nationalityFrontIdImage'],
                'nationalityBackIdImage'=>$data['nationalityBackIdImage'],
                'profileImage'=>$data['profileImage'],
                'active'=>$data['active'],
                'working'=>$data['working'],
                'type' =>$data['type' ],
                'lat'=>$data['lat'],
                'long'=>$data['long'],
            ]);
        }



        if ($deliveryMan) {

            $deliveryManInfo = new DeliveryManInfoResource($deliveryMan);
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','deliveryMen',$deliveryManInfo);
        }
        else{
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** logout function ***/
    public function logout()
    {
        try {
            auth('api-deliveryMan')->logout();
            return $this->returnMessageSuccess('تم تسجيل الخروج بنجاح','201');
        }
        catch (\Exception $exception){
            return $this->returnMessageError($exception->getMessage(),'500');
        }
    }


} //end of class
