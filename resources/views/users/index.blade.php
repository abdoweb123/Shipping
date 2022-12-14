@extends('layouts.master')
@section('css')
@section('title')
    قائمة الموظفين
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الموظفين
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


                    <a href="{{route('users.create')}}" class="button x-small">
                        إضافة موظف
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم بالكامل</th>
                                <th>الرقم القومي</th>
                                <th>الصورة الشخصية</th>
                                <th>صورة بطاقة الهوية</th>
                                <th>الجنسية</th>
                                <th>الدولة</th>
                                <th>المدينة</th>
                                <th>البريد الإلكتروني</th>
                                <th>العنوان بالتفصيل</th>
                                <th>منطقة العمل</th>
                                <th>التخصص</th>
                                <th>الهاتف الشخصي</th>
                                <th>هاتف قريب أو صاحب</th>
                                <th>النوع</th>
                                <th>تاريخ الميلاد</th>
                                <th>الشهادة الصحية</th>
                                <th>الفيش و التشبيه</th>
                                <th>كيف عرفتنا؟</th>
                                <th>فيديو التقديم بالعربية</th>
                                <th>فيديو التقديم بالإنجليزية</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['users'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->id_number}}</td>
                                    <td><img src="{{asset('assets/images/'. $item->profile_image)}}" alt="profile_image" style="width:100px;"></td>
                                    <td><img src="{{asset('assets/images/'. $item->identity_image)}}" alt="identity_image" style="width:100px;"></td>
                                    <td>@isset($item->nationality->name)  {{ $item->nationality->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->country->name)  {{ $item->country->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else لا يوجد @endisset</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->area}}</td>
                                    <td>@isset($item->workingArea->name)  {{ $item->workingArea->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->specialty->name)  {{ $item->specialty->name }} @else لا يوجد @endisset</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->relative_phone}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->birthDate}}</td>
                                    <td>{{$item->health_insurance}}</td>
                                    <td>{{$item->antecedents}}</td>
                                    <td>@isset($item->reachedUs->name)  {{ $item->reachedUs->name }} @else لا يوجد @endisset</td>
                                    <td>{{$item->arabic_video_url}}</td>
                                    <td>@isset($item->english_video_url)  {{ $item->english_video_url }} @else لا يوجد @endisset</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <a type="button" href="{{route('users.edit',$item->id)}}" class="process"
                                           style="cursor:pointer; background-color:darkgoldenrod;">
                                           <i style="color:white" class="fa fa-edit"></i></a>

                                        <button type="button" class="process" style="cursor:pointer; background-color: lightgray; border-radius:3px;"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('users.delete')


                            @endforeach
                        </table>

                        <div> {{$data['users']->links('pagination::bootstrap-4')}}</div>
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




