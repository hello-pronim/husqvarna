<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['before.call']], function(){

	Route::post('/importPoList', 'ApiController@uploadOrder');
	Route::post('/importPoDetail', 'ApiController@uploadProduct');
	Route::post('/updatePoStatus', 'ApiController@updatePoStatus');

});

Route::get('/checkPoStatus', 'ApiController@checkTrackingStatus');



