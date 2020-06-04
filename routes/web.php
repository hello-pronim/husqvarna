<?php

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
Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Route::group(['middleware' => ['auth']], function(){

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/orders', 'DashboardController@orders')->name('orders');


	Route::post('/po_uploadcsv', 'DashboardController@uploadCSV')->name('po_uploadcsv');
	Route::post('/ajax_dashbaord', 'DashboardController@ajax_dashbaord')->name('ajax_dashbaord');
	Route::post('/ajax_direct_order', 'DashboardController@ajax_direct_order')->name('ajax_direct_order');
	Route::post('/ajax_tracking_update', 'DashboardController@ajax_tracking_update')->name('ajax_tracking_update');
	
	Route::get('/manage/user', 'ManageController@user_list')->name('management.user');
	Route::get('/manage/csv_import', 'ManageController@csv_import')->name('management.csv_import');
});

Route::get('/register', function(){
	return false;
});

Route::get('/register_nl', 'Auth\RegisterController@showRegistrationForm')->name('register_nl');
Route::post('/register_nl', 'Auth\RegisterController@register');



