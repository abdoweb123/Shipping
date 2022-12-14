@extends('layouts.master')
@section('css')
@section('title')
    قائمة الشركات
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الشركات
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach


                    <a href="{{route('companies.create')}}" class="button x-small">
                        إضافة شركة
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشركة باللغة العربية</th>
                                <th>اسم الشركة باللغة الانجليزية</th>
                                <th>البريد الإلكتروني للشركة</th>
                                <th>رقم هاتف الشركة</th>
                                <th>مدينة تواجد الشركة</th>
                                <th>الاسم الرباعي لممثل الشركة</th>
                                <th>البريد الإلكتروني لممثل الشركة</th>
                                <th>صورة شعار الشركة</th>
                                <th>صورة شكل الشركة</th>
                                <th>صورة هوية ممثل الشركة</th>
                                <th>صورة السجل التجاري</th>
                                <th>صورة الترخيص</th>
                                <th>صورة الوكالة الشرعية لممثل الشركة</th>
                                <th>العنوان الوطني</th>
                                <th>خدمات الشركة</th>
                                <th>الوظائف التي سيتم الإعلان عنها</th>
                                <th>صورة العقد بين الشركة وال R7</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('company_name', 'ar') }}</td>
                                    <td>{{ $item->getTranslation('company_name', 'en') }}</td>
                                    <td>{{ $item->company_email }}</td>
                                    <td>{{ $item->company_phone }}</td>
                                    <td>{{ $item->city_id }}</td>
                                    <td>{{ $item->pre_fullName }}</td>
                                    <td>{{ $item->pre_email }}</td>
                                    <td><img src="{{asset('assets/images/'. $item->logo_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->cover_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->pre_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->commercialRecord_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->licence_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->pre_agent_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td>{{ $item->national_address }}</td>
                                    <td>{{ $item->services }}</td>
                                    <td>{{ $item->jobs }}</td>
                                    <td><img src="{{asset('assets/images/'. $item->contract_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <a type="button" href="{{route('companies.edit',$item->id)}}" class="process"
                                           style="cursor:pointer; background-color:darkgoldenrod;">
                                           <i style="color:white" class="fa fa-edit"></i></a>

                                        <button type="button" class="process" style="cursor:pointer; background-color: lightgray; border-radius:3px;"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('companies.delete')


                            @endforeach
                        </table>

                        <div> {{$companies->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection




