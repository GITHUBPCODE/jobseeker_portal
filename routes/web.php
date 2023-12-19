<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Storage;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::resource('jobseeker', JobSeekerController::class);

Route::middleware('role:admin')->group(function () {
    Route::resource('admin', AdminController::class);
});

//Route::middleware('role:user')->group(function () {
    Route::get('/changepass', function () {
        return view('jobseeker.changepass');
    });
    Route::post('/changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
//});