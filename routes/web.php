<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ToolTypeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){

    Route::group(['middleware'=>['guest']], function ()
    {
        Route::get('/', function () { return view('auth.login'); });
    });


    // ======================  login page ======================
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('/login/test', [LoginController::class , 'login'])->middleware('guest')->name('loginTest');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });


    // dashboard of admin
    Route::get('/dashboard', function (){ return view('dashboard'); })->middleware('auth:admin');



    Route::resource('ads','AdController')->except('create','edit','show');
    Route::resource('states','StateController')->except('create','edit','show');
    Route::resource('toolTypes','ToolTypeController')->except('create','edit','show');

    // ======================  Admin ======================
//    Route::group(['prefix' => 'branches'], function ()
//    {
//        Route::get('register/admin/view', [AdminController::class, 'registerView'])->name('registerView')->middleware('auth:admin');
//        Route::post('register/test', [AdminController::class, 'registerTest'])->name('registerTest');
//        Route::get('/admin/dashboard', function (){ return view('admin.dashboard'); });
//    });



}); //end of routes

