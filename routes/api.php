<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DeliveryManController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api', 'namespace'=>'Api'], function () {


    //admin routes
    Route::group(['prefix'=>'admin'], function ()
    {
        Route::post('register/admin',[AdminController::class,'register'])->middleware('check:api-admin');
        Route::post('login/admin',[AdminController::class,'login']);
        Route::get('get/all/admins',[AdminController::class,'getAllAdmins'])->middleware('check:api-admin');
        Route::get('get/admin/{id}',[AdminController::class,'getAdmin'])->middleware('check:api-admin');
        Route::post('update/admin/{id}',[AdminController::class,'update'])->middleware('check:api-admin');
        Route::post('logout/admin',[AdminController::class,'logout'])->middleware('check:api-admin');
    });


    Route::group(['prefix'=>'user'], function ()
    {
        Route::post('register/user',[UserController::class,'register']);
        Route::post('login/user',[UserController::class,'login']);
        Route::get('get/all/users',[UserController::class,'getAllUsers'])->middleware('check:api-user');
        Route::get('get/user/{id}',[UserController::class,'getUser'])->middleware('check:api-user');
        Route::post('update/user/{id}',[UserController::class,'update'])->middleware('check:api-user');
        Route::post('logout/user',[UserController::class,'logout'])->middleware('check:api-user');
    });


    Route::group(['prefix'=>'deliveryMan'], function ()
    {
        Route::post('register/deliveryMan',[DeliveryManController::class,'register']);
        Route::post('login/deliveryMan',[DeliveryManController::class,'login']);
        Route::get('get/all/deliveryMen',[DeliveryManController::class,'getAllDeliveryMen'])->middleware('check:api-deliveryMan');
        Route::get('get/deliveryMan/{id}',[DeliveryManController::class,'getDeliveryMan'])->middleware('check:api-deliveryMan');
        Route::post('update/deliveryMan/{id}',[DeliveryManController::class,'update'])->middleware('check:api-deliveryMan');
        Route::post('logout/deliveryMan',[DeliveryManController::class,'logout'])->middleware('check:api-deliveryMan');
    });


    Route::group(['prefix'=>'offer'], function ()
    {
        Route::post('create/offer',[OfferController::class,'create']);
        Route::get('get/all/offers',[OfferController::class,'getAllOffers']);
        Route::get('get/offer/{id}',[OfferController::class,'getOffer']);
        Route::post('update/offer/{id}',[OfferController::class,'update']);
        Route::get('delete/offer/{id}',[OfferController::class,'delete']);
    });


    Route::group(['prefix'=>'review'], function ()
    {
        Route::post('create/review',[ReviewController::class,'create']);
        Route::get('get/all/reviews',[ReviewController::class,'getAllReviews']);
        Route::get('get/review/{id}',[ReviewController::class,'getReview']);
        Route::post('update/review/{id}',[ReviewController::class,'update']);
        Route::get('delete/review/{id}',[ReviewController::class,'delete']);
    });


}); //end of routes
