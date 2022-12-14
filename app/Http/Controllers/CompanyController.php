<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }



    /*** create function ***/
    public function create()
    {
        $cities = City::select('id','name')->get();
        return view('companies.create', compact('cities'));
    }




    /*** store function ***/
    public function store(CompanyStoreRequest $request)
    {

        $data = $request->all();

        if( $image = $request->file('logo_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['logo_image'] = "$photo";
        }


        if( $image = $request->file('cover_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['cover_image'] = "$photo";
        }


        if( $image = $request->file('pre_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['pre_image'] = "$photo";
        }

        if( $image = $request->file('commercialRecord_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['commercialRecord_image'] = "$photo";
        }


        if( $image = $request->file('licence_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['licence_image'] = "$photo";
        }

        if( $image = $request->file('pre_agent_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['pre_agent_image'] = "$photo";
        }

        if( $image = $request->file('contract_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['contract_image'] = "$photo";
        }


        $company = new Company();
        $company->company_name = ['en' => $request->company_name_en, 'ar' => $request->company_name_ar];
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->city_id = $request->city_id;
        $company->pre_fullName = $request->pre_fullName;
        $company->pre_email = $request->pre_email;
        $company->logo_image = $date['logo_image'];
        $company->cover_image = $date['cover_image'];
        $company->pre_image = $date['pre_image'];
        $company->commercialRecord_image = $date['commercialRecord_image'];
        $company->licence_image = $date['licence_image'];
        $company->pre_agent_image = $date['pre_agent_image'];
        $company->national_address = $request->national_address;
        $company->services = $request->services;
        $company->jobs = $request->jobs;
        $company->contract_image = $date['contract_image'];
        $company->active = $request->active;
        $company->save();


        return redirect()->route('companies.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** edit function ***/
    public function edit(Company $company)
    {
        $cities = City::select('id','name')->get();
        return view('companies.edit', compact('cities','company'));
    }




    /*** update function ***/
    public function update(CompanyUpdateRequest $request, Company $company)
    {

        $data = $request->all();

        if( $image = $request->file('logo_image'))
        {
            $image_path = 'assets/images/'.$company->logo_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['logo_image'] = "$photo";
            $company->update(['logo_image'=>$data['logo_image']]);
        }
        else{
            unset($data['logo_image']);
        }


        if( $image = $request->file('cover_image'))
        {
            $image_path = 'assets/images/'.$company->cover_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['cover_image'] = "$photo";
            $company->update(['cover_image'=>$data['cover_image']]);
        }
        else{
            unset($data['cover_image']);
        }



        if( $image = $request->file('pre_image'))
        {
            $image_path = 'assets/images/'.$company->pre_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['pre_image'] = "$photo";
            $company->update(['pre_image'=>$data['pre_image']]);
        }
        else{
            unset($data['pre_image']);
        }

        if( $image = $request->file('commercialRecord_image'))
        {
            $image_path = 'assets/images/'.$company->commercialRecord_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['commercialRecord_image'] = "$photo";
            $company->update(['commercialRecord_image'=>$data['commercialRecord_image']]);
        }
        else{
            unset($data['commercialRecord_image']);
        }


        if( $image = $request->file('licence_image'))
        {
            $image_path = 'assets/images/'.$company->licence_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['licence_image'] = "$photo";
            $company->update(['licence_image'=>$data['licence_image']]);
        }
        else{
            unset($data['licence_image']);
        }

        if( $image = $request->file('pre_agent_image'))
        {
            $image_path = 'assets/images/'.$company->pre_agent_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['pre_agent_image'] = "$photo";
            $company->update(['pre_agent_image'=>$data['pre_agent_image']]);
        }
        else{
            unset($data['pre_agent_image']);
        }

        if( $image = $request->file('contract_image'))
        {
            $image_path = 'assets/images/'.$company->contract_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['contract_image'] = "$photo";
            $company->update(['contract_image'=>$data['contract_image']]);
        }
        else{
            unset($data['contract_image']);
        }


        $company->company_name = ['en' => $request->company_name_en, 'ar' => $request->company_name_ar];
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->city_id = $request->city_id;
        $company->pre_fullName = $request->pre_fullName;
        $company->pre_email = $request->pre_email;
        $company->national_address = $request->national_address;
        $company->services = $request->services;
        $company->jobs = $request->jobs;
        $company->active = $request->active;
        $company->update();

        return redirect()->route('companies.index')->with('alert-success','تم تعديل البيانات بنجاح');
    }




    /*** destroy function ***/
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('alert-success','تم حذف البيانات بنجاح');
    }

} //end of class
