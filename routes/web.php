<?php

use App\Http\Controllers\CategoryKnowledgeCtl;
use App\Http\Controllers\CustomerBidsCtl;
use App\Http\Controllers\JobsCtl;
use App\Http\Controllers\LoginCtl;
use App\Http\Controllers\SubcategoryKnowledgeCtl;
use App\Http\Controllers\UserCtl;
use App\Http\Controllers\WebContactCtl;
use App\Http\Controllers\WebMessageCtl;
use App\Models\CustomerBids;
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
Route::resource('/jobs', JobsCtl::class);
Route::post('/select/jobs', [JobsCtl::class, 'search']);
Route::post('/view/jobs', [JobsCtl::class, 'viewJob']);
Route::post('/view/posted-jobs', [JobsCtl::class, 'allPostedJobs']);
Route::resource('/category-knowledges', CategoryKnowledgeCtl::class);
Route::post('/category-knowledges/select', [CategoryKnowledgeCtl::class, 'search']);
Route::resource('/sub-category-knowledges', SubcategoryKnowledgeCtl::class);
Route::post('/sub-category-knowledges/select', [SubcategoryKnowledgeCtl::class, 'search']);
Route::resource('/job-bids', CustomerBidsCtl::class);
Route::get('/job-bids/get/{id}', [CustomerBidsCtl::class, 'getJobBids']);
