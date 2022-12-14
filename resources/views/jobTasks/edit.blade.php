@extends('layouts.master')
@section('css')
@section('title')
    تعديل بيانات المهمة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   تعديل بيانات المهمة
@stop
<!-- breadcrumb -->
@endsection
@section('content')

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


    <!-- row mb-3 -->
    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{ route('jobTasks.update',$jobTask->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">اسم المهمة باللغة العربية</label>
                                <input type="text" name="name_ar" value="{{old('name_ar',$jobTask->getTranslation('name', 'ar'))}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">اسم المهمة باللغة الإنجليزية</label>
                                <input type="text" name="name_en" value="{{old('name_en',$jobTask->getTranslation('name', 'en'))}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">وصف المهمة باللغة العربية</label>
                                <input type="text" name="description_ar" value="{{old('description_ar',$jobTask->getTranslation('description', 'ar'))}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">وصف المهمة باللغة الإنجليزية</label>
                                <input type="text" name="description_en" value="{{old('description_en',$jobTask->getTranslation('description', 'en'))}}" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                <select name="active" class="form-control">
                                    @if($jobTask->active == 1)
                                        <option value="1" selected>نشط</option>
                                        <option value="2">غير نشط</option>
                                    @else
                                        <option value="1">نشط</option>
                                        <option value="2" selected>غير نشط</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <br><br>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
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
