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
Route::POST('lawbreaker/home/get-location','LawbreakerController@getLocation')->name('lawbreaker.getLocation');
Route::GET('lawbreaker/home/show-orders','LawbreakerController@showOrders')->name('lawbreaker.showOrders');
Route::GET('lawbreaker/home/fetch-order','LawbreakerController@fetchOrder')->name('lawbreaker.fetchOrders');
Route::GET('lawbreaker/home/delivered/{order_id}','LawbreakerController@delivered')->name('lawbreaker.delivered');
Route::GET('lawbreaker/home/get-distance','LawbreakerController@getDistance')->name('lawbreaker.getDistance');
Route::GET('lawbreaker/home/get-stats','LawbreakerController@getStats')->name('lawbreaker.getStats');



Route::GET('manager/home','ManagerController@index');
Route::GET('manager','Manager\LoginController@showLoginForm')->name('manager.login');
Route::POST('manager','Manager\LoginController@login');
Route::POST('manager-password/email','Manager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
Route::GET('manager-password/reset','Manager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
Route::POST('password/reset','Manager\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Manager\ResetPasswordController@showResetForm')->name('manager.password.reset');

Route::GET('admin/home','AdminController@index');
Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin','Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('password/reset','Admin\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::GET('admin/home/payroll','AdminController@getPayroll');
Route::POST('admin/home/payroll','AdminController@payroll')->name('admin.payroll');
Route::GET('admin/home/new-store','AdminController@getNewStore');
Route::POST('admin/home/new-store','AdminController@newStore')->name('admin.newStore');

//takes id as param
Route::get('/add-to-cart/{id}',[
    'uses' => 'productsController@getAddToCart',
    'as' => 'shop.addToCart'
]);

Route::get('/shopping-cart',[
    'uses' => 'productsController@getCart',
    'as' => 'shop.shopping-cart'

]);



//Route::get('/checkout', [
//    'uses' => 'productsController@getCheckout',
//    'as' => 'shop.checkout'
//]);

Route::post('/checkout', [
    'uses' => 'productsController@getCheckout',
    'as' => 'shop.checkout'
]);

//Route::post('/checkout', function(){
//    if(Request::ajax()){
//        return var_dump(Response::json(Request::all()));
//    }
//});


//This way all the request at order will be redirected at the productsController
Route::get('order', [
    'uses' => 'productsController@getIndex',
    'as' => 'shop.index',
//    'middleware' => 'auth'
]);


