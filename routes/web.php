<?php

use App\Http\Controllers\LoginCtl;
use App\Http\Controllers\UserCtl;
use App\Http\Controllers\WebContactCtl;
use App\Http\Controllers\WebMessageCtl;
use App\Models\WebMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('website.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserCtl::class);
Route::resource('/login', LoginCtl::class);
Route::get('/logout/system', [LoginCtl::class,'logout']);
Route::get('/check/user-session', [LoginCtl::class,'checkUserSession']);
Route::resource('/webcontacts', WebMessageCtl::class);
Route::post('/select/webcontact', [WebMessageCtl::class, 'search']);
