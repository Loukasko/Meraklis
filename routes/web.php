<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::GET('lawbreaker/home','LawbreakerController@index');
Route::GET('lawbreaker','Lawbreaker\LoginController@showLoginForm')->name('lawbreaker.login');
Route::POST('lawbreaker','Lawbreaker\LoginController@login');
Route::POST('lawbreaker-password/email','Lawbreaker\ForgotPasswordController@sendResetLinkEmail')->name('lawbreaker.password.email');
Route::GET('lawbreaker-password/reset','Lawbreaker\ForgotPasswordController@showLinkRequestForm')->name('lawbreaker.password.request');
Route::POST('password/reset','Lawbreaker\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Lawbreaker\ResetPasswordController@showResetForm')->name('lawbreaker.password.reset');
Route::GET('lawbreaker/home/change-status','LawbreakerController@changeStatus')->name('lawbreaker.changeStatus');
Route::POST('/lawbreaker/home/get-location','LawbreakerController@getLocation')->name('lawbreaker.getLocation');

Route::GET('manager/home','ManagerController@index');
Route::GET('manager','Manager\LoginController@showLoginForm')->name('manager.login');
Route::POST('manager','Manager\LoginController@login');
Route::POST('manager-password/email','Manager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
Route::GET('manager-password/reset','Manager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
Route::POST('password/reset','Manager\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Manager\ResetPasswordController@showResetForm')->name('manager.password.reset');





