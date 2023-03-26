<?php

use App\Http\Controllers\AccountController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RedirectController;
use App\Models\Programmer;
use App\Models\Project;

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

Route::get('/about', function () {
    return view('welcome');
});

//---semua route disini bisa dilakukan meskipun user belum login---

    Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/',[LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login',[LoginController::class, 'authenticate']);
    Route::post('/logout',[LoginController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);

//---batas akhir route bisa dilakukan meskipun user belum login---


//semua route disini hanya bisa dilakukan oleh semua role
Route::group(['middleware' => ['auth']],function(){
        //Route Ganti Password
        Route::get('/changepass',[AccountController::class, 'index']);
        Route::post('/confirmpass',[AccountController::class, 'confirmpass']);
        Route::get('/riwayat',[ProjectController::class, 'history']);
        //
});

//semua route disini hanya bisa dilakukan bila login dengan akun koordinator / BPA
Route::group(['middleware' => ['auth','checkrole:koordinator,BPA']],function(){
    //CRUD User
    Route::post('/register',[RegisterController::class, 'store']);
    Route::get('/edit/{id}',[RegisterController::class, 'edit']);
    Route::post('/update/{id}',[RegisterController::class, 'update']);
    Route::get('/delete/{id}',[RegisterController::class, 'destroy']);

    // Route CRUD PROJECT
    Route::post('/create',[ProjectController::class, 'store']);

    // Route CRUD FITUR
    Route::post('/detailverifikasi/fitur/{id}',[ProjectController::class, 'addfit']);
    Route::get('/detailverifikasi/fitur/$id/{id}',[ProjectController::class, 'destroyfit']);
    Route::get('/projectpage',[KoordinatorController::class, 'viewproject']);

    // Route CRUD PROGRAMMER
    Route::post('/detailverifikasi/programmer/{id}',[ProjectController::class, 'addprog']);
    Route::get('/detailverifikasi/programmer/$id/{id}',[ProjectController::class, 'destroy']);

    Route::get('/progresview',[KoordinatorController::class, 'progresdetail']);

    Route::get('/koordinator',[DashboardController::class, 'koor']);
    Route::get('/BPA',[DashboardController::class, 'BPA']);
    Route::get('/listkoordinator',[KoordinatorController::class, 'index']);
    Route::get('/listpimpinan',[KoordinatorController::class, 'index2']);
    Route::get('/listprogrammer',[KoordinatorController::class, 'index3']);
    Route::get('/listbpa',[KoordinatorController::class, 'index4']);

    Route::get('/detailproject/{id}',[KoordinatorController::class, 'project']);
    Route::get('/fiturview/{id}',[KoordinatorController::class, 'view']);
    Route::get('/projecton',[KoordinatorController::class, 'showon']);
    Route::get('/projectfinish',[KoordinatorController::class, 'showfinish']);
    Route::get('/detailverifikasi/{id}',[KoordinatorController::class, 'show']);
    Route::get('/detailongoing/{id}',[KoordinatorController::class, 'showongoing']);
    Route::post('/verifikasi/{id}',[ProjectController::class, 'verifikasi']);

    Route::post('/accproject/{id}',[KoordinatorController::class, 'acc']);

    Route::get('/edit/{id}',[ProjectController::class, 'edit']);
    Route::post('/update/{id}',[ProjectController::class, 'update']);
    Route::get('/deleteproject/{id}',[ProjectController::class, 'destroyproject']);


});

//semua route disini hanya bisa dilakukan bila login dengan akun programmer
Route::group(['middleware' => ['auth','checkrole:programmer']],function(){
    Route::get('/programmer',[DashboardController::class, 'prog']);
    Route::get('/progreslist',[ProgrammerController::class, 'progres']);
    Route::get('/finishproject',[ProgrammerController::class, 'projectfinish']);
    Route::get('/progresdetail/{id}',[ProgrammerController::class, 'detail']);
    Route::post('/updateprogres/{id}',[ProgrammerController::class, 'update']);
    Route::get('/progresconfirm/{id}',[ProgrammerController::class, 'confirmfinish']);
    Route::post('/projectdone/{id}',[ProgrammerController::class, 'done']);

});

//semua route disini hanya bisa dilakukan bila login dengan akun pimpinan
    Route::group(['middleware' => ['auth','checkrole:pimpinan']],function(){
    Route::get('/pimpinan',[DashboardController::class, 'pimpinan']);
    Route::get('/projectshowon',[PimpinanController::class, 'showon']);
    Route::get('/detailshowon/{id}',[PimpinanController::class, 'project']);
    Route::get('/projectshowfinish',[PimpinanController::class, 'showfinish']);
    Route::get('/fiturdetail/{id}',[PimpinanController::class, 'view']);
    
});

