<?php


use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferedTaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ReachedUsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobTaskController;
use App\Http\Controllers\JobRequirementController;
use App\Http\Controllers\JobTermsController;

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


    Route::get('', function (){ return view('dashboard'); });


    Route::resource('countries','CountryController')->except('show','edit','create');
    Route::resource('nationalities','NationalityController')->except('show','edit','create');
    Route::resource('cities','CityController')->except('show','edit','create');
    Route::resource('reachedUs','ReachedUsController')->except('show','edit','create');
    Route::resource('specialties','SpecialtyController')->except('show','edit','create');
    Route::resource('users','UserController');
    Route::resource('companies','CompanyController')->except('show');

    Route::resource('jobs','JobController')->except('show');
    Route::get('all/jobs/{job_id}',[JobController::class,'returnJob'])->name('returnJob');

    Route::resource('jobTasks','JobTaskController')->except('show','index');
    Route::get('jobTasks/create/{job_id}/{company_id}',[JobTaskController::class,'create'])->name('jobTasks.create');
    Route::get('all/jobTasks/{job_id}/{company_id}',[JobTaskController::class,'index'])->name('jobTasks.index');


    Route::resource('jobRequirements','JobRequirementController')->except('show','edit','create','index');
    Route::get('jobRequirements/create/{job_id}/{company_id}}',[JobRequirementController::class,'create'])->name('jobRequirements.create');
    Route::get('all/jobRequirements/{job_id}/{company_id}',[JobRequirementController::class,'index'])->name('jobRequirements.index');

    Route::resource('jobTerms','JobTermsController')->except('show','edit','create','index');
    Route::get('jobTerms/create/{job_id}/{company_id}}',[JobTermsController::class,'create'])->name('jobTerms.create');
    Route::get('all/jobTerms/{job_id}/{company_id}',[JobTermsController::class,'index'])->name('jobTerms.index');


    Route::get('all/offers',[OfferController::class,'index'])->name('offers.index');
    Route::put('update/offers/{id}',[OfferController::class,'update'])->name('offer.update');
    Route::delete('delete/offers/{id}',[OfferController::class,'destroy'])->name('offer.destroy');

    Route::get('all/offeredTasks',[OfferedTaskController::class,'index'])->name('offeredTasks.index');
    Route::put('update/offeredTask/{id}',[OfferedTaskController::class,'update'])->name('offeredTask.update');
    Route::delete('delete/offeredTasks/{id}',[OfferedTaskController::class,'destroy'])->name('offeredTask.destroy');
}); //end of routes

