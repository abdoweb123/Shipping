<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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
        Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
    });


    // dashboard of user
    Route::get('/user/dashboard', function () { return view('user.dashboard'); })->name('user.dashboard')->middleware('auth:web');

    // dashboard of deliveryMan
    Route::get('/deliveryMan/dashboard', function () { return view('deliveryMan.dashboard'); })->name('deliveryMan.dashboard')->middleware('auth:deliveryMan');





    // ======================  Admin ======================
//    Route::group(['prefix' => 'branches'], function ()
//    {
//        Route::get('register/admin/view', [AdminController::class, 'registerView'])->name('registerView')->middleware('auth:admin');
//        Route::post('register/test', [AdminController::class, 'registerTest'])->name('registerTest');
//        Route::get('/admin/dashboard', function (){ return view('admin.dashboard'); });
//    });



}); //end of routes

