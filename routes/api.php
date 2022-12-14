<?php

use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OfferedTaskController;
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


    Route::group(['prefix'=>'offer'], function ()
    {
        Route::post('create/offer',[OfferController::class,'create']);
        Route::get('get/all/offers',[OfferController::class,'getAllOffers']);
        Route::get('get/offer/{id}',[OfferController::class,'getOffer']);
        Route::post('update/offer/{id}',[OfferController::class,'update']);
        Route::get('delete/offer/{id}',[OfferController::class,'delete']);
    });


    Route::group(['prefix'=>'offeredTask'], function ()
    {
        Route::post('create/offeredTask',[OfferedTaskController::class,'create']);
        Route::get('get/all/offeredTasks',[OfferedTaskController::class,'getAllOfferedTasks']);
        Route::get('get/offeredTask/{id}',[OfferedTaskController::class,'getOfferedTask']);
        Route::post('update/offeredTask/{id}',[OfferedTaskController::class,'update']);
        Route::get('delete/offeredTask/{id}',[OfferedTaskController::class,'delete']);
    });


}); //end of routes
