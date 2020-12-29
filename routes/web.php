<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Auth\GithubLoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Products\CategoriesController;

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

Route::group(['prefix' => 'login'], function () {

    Route::get('/' , [LoginController::class , 'index'])->name('login');
    Route::post('/' , [LoginController::class , 'authenticate'])->name('login.confirm');

    //Forgotten Password
    Route::get('/forgot-password' , [ForgetPasswordController::class,'forgetPasswordIndex'] )->name('login.forget-password');
    Route::post('/forgot-password' ,[ForgetPasswordController::class,'forgetPasswordStore'] )->name('login.passwor_store');
    
    Route::get('/password-confirm' ,[ForgetPasswordController::class,'resetConfirmForm']);
    Route::post('/password-confirm' ,[ForgetPasswordController::class,'resetConfirm'])->name('reset.confirm');
    //Social Media Authentication
    // Google Authentication
    Route::get('/google' , [GoogleLoginController::class , "redirectToGoogle"])->name('login.google');
    Route::get('/google/callback' , [GoogleLoginController::class , 'googleCallback']);
    
    // Facebook Authentication
    Route::get('/facebook' , [FacebookLoginController::class,'redirectToFacebook'])->name('login.facebook');
    Route::get('/facebook/callback' , [FacebookLoginController::class,'facebookCallback']);
    
    // Github Authentication
    Route::get('/github' , [GithubLoginController::class,'redirectToGithub'])->name('login.github');
    Route::get('/github/callback' , [GithubLoginController::class,'githubCallback']);
});

Route::get('/',function(){
    return redirect()->to('dashboard'); 
});
// Middleware
Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/logout' , [LoginController::class , 'logout'])->name('logout');

Route::resource('users',UserController::class);

Route::get('/group', 'App\Http\Controllers\Users\UserGroupController@index')->name('group');
Route::post('/group', 'App\Http\Controllers\Users\UserGroupController@create')->name('group');
Route::delete('group/{id}', 'App\Http\Controllers\Users\UserGroupController@delete')->name('group.destroy');

Route::resource('categories', CategoriesController::class ,  ['except' => ['show']]);
Route::resource('products', ProductsController::class);

});