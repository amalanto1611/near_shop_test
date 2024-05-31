<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Customerlogcontroller;



//initial view ligin
Route::get('/', function () {
    return view('login.index');
});


Route::group(['middleware' => 'auth'], function () {

    //dashboad view 
    Route::get('/dashboard', [LoginController::class, 'dash'])->name('dashboard');
    Route::get('shops/search', [LoginController::class, 'search'])->name('shops.search');

    //admin privilages add create shop delete
    Route::get('/createshow', [Admincontroller::class, 'show'])->name('shops.create');
    Route::post('/createshop', [Admincontroller::class, 'createshop'])->name('create');
    Route::get('/editshow/{id}', [Admincontroller::class, 'editshow'])->name('shops.edit');
    Route::post('/update/{id}', [Admincontroller::class, 'updateshop'])->name('shops.update');
    Route::get('/delete/{id}', [Admincontroller::class, 'deleteshop'])->name('shops.delete');

});

//sign up and log in admin and customer 
Route::post('/logincheck', [Logincontroller::class, 'check'])->name('login.check');
Route::get('/login/back', [Logincontroller::class, 'show'])->name('login');
Route::get('/register', [Customerlogcontroller::class, 'showRegistrationForm'])->name('register');
Route::post('/register/signup', [Customerlogcontroller::class, 'register'])->name('registersignup');
//logout route

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

