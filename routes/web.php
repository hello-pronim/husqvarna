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
	Route::post('/po_uploadcsv', 'DashboardController@uploadCSV')->name('po_uploadcsv');

	Route::get('/manage', 'ManageController@index')->name('management');
});

Route::get('/register', function(){
	return false;
});

Route::get('/register_nl', 'Auth\RegisterController@showRegistrationForm')->name('register_nl');
Route::post('/register_nl', 'Auth\RegisterController@register');



