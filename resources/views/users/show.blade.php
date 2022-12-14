@extends('layouts.master')
@section('css')
@section('title')
    عرض بيانات الموظف
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}


     .my-container{/*margin:50px auto; width:500px*/}
    ul{list-style:none; margin:0; padding:0 !important;}
    ul .li-tab{display:inline-block; background-color:#eee; padding:5px; cursor:pointer; margin-left: 10px;}
    ul .inactive{background-color:#ddd;}
    .my-container ~ div{min-height:200px; margin-top:20px; /*background-color:#eee; padding:10px; */ }
    .my-container ~ div:not(:first-of-type){display:none}


</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  عرض بيانات الموظف
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
                    <div class="my-container">
                        <ul id="my-taps">
                            <li id="tap1" class="li-tab">بيانات الموظف</li>
                            <li id="tap2" class="inactive li-tab">الأعمال السابقة</li>
{{--                            <li id="tap3" class="inactive tabs">About</li>--}}
{{--                            <li id="tap4" class="inactive tabs">Contact</li>--}}
                        </ul>

                        <div id="tap1-content">
                            <div class="row">
                                <div class="col">
                                    <img style="border-radius: 50%; width: 150px;  height: 150px" src="{{asset('assets/images/'.$user->profile_image)}}" alt="">
                                    <div class="mt-4">
                                        <label class="d-inline">الاسم بالكامل</label>
                                        <p style="font-weight:bold">{{$user->full_name}}</p>
                                    </div>
                                    <div class="mt-4">
                                        <label class="d-inline">الرقم القومي</label>
                                        <p style="font-weight:bold">{{$user->id_number}}</p>
                                    </div>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                        <div id="tap2-content">الأعمال السابقة</div>
{{--                        <div id="tap3-content">About content</div>--}}
{{--                        <div id="tap4-content">Contact content</div>--}}
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


        $(document).ready(function(){
            $("#my-taps li").click(function(){

                var myId = $(this).attr("id");

                $(this).removeClass("inactive").siblings().addClass("inactive");

                $(".my-container > div").hide();

                $("#" + myId + "-content").fadeIn(0);

            });
        });

    </script>
@endsection
