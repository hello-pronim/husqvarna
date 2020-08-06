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
	Route::get('/order/{po}', 'DashboardController@order_detail')->name('order_detail');
	Route::get('/po_detail_pdf/{id}','DashboardController@po_detail_pdf')->name('po_detail_pdf');
	Route::get('/orders/change_date_format', 'DashboardController@change_date_format');

	Route::post('/po_uploadcsv', 'DashboardController@uploadCSV')->name('po_uploadcsv');
	Route::post('/tracking_uploadcsv', 'DashboardController@uploadTrackingCSV')->name('tracking_uploadcsv');
	Route::post('/aws_customer_csv', 'ManageController@awsCustomerCSV')->name('aws_customer_csv');

	Route::post('/ajax_dashbaord', 'DashboardController@ajax_dashbaord')->name('ajax_dashbaord');
	Route::post('/ajax_direct_order', 'DashboardController@ajax_direct_order')->name('ajax_direct_order');
	Route::post('/ajax_tracking_update', 'DashboardController@ajax_tracking_update')->name('ajax_tracking_update');
	Route::post('/ajax_order_products', 'DashboardController@ajax_order_products')->name('ajax_order_products');
	Route::post('/ajax_esker_email', 'DashboardController@ajax_esker_email')->name('ajax_esker_email');
	Route::post('/ajax_product_tracking', 'DashboardController@ajax_product_tracking')->name('ajax_product_tracking');	
	Route::post('/ajax_import_po_csv', 'DashboardController@ajax_import_po_csv')->name('ajax_import_po_csv');	
	Route::post('/ajax_get_apis', 'ApiManageController@ajax_get_apis')->name('ajax_get_apis');
	Route::post('/ajax_api_alert_update', 'ApiManageController@updateApiAlert')->name('ajax_api_alert_update');
	Route::post('/ajax_api_via_update', 'ApiManageController@updateApiVia')->name('ajax_api_via_update');
	Route::post('/ajax_api_receiver_add', 'ApiManageController@addApiReceiver')->name('ajax_api_receiver_add');
	Route::post('/ajax_api_receiver_edit', 'ApiManageController@editApiReceiver')->name('ajax_api_receiver_edit');
	Route::post('/ajax_api_receiver_delete', 'ApiManageController@deleteApiReceiver')->name('ajax_api_receiver_delete');

	
	Route::get('/manage/user', 'ManageController@user_list')->name('management.user');
	Route::get('/manage/csv_import', 'ManageController@po_csv_import')->name('management.po_csv_import');	
	Route::get('/manage/direct_csv_import', 'ManageController@direct_csv_import')->name('management.direct_csv_import');	
	Route::get('/manage/aws_customer_csv_import', 'ManageController@aws_customer_csv_import')->name('management.aws_customer_csv_import');	

	Route::post('/user/change_usertype', 'ManageController@change_usertype')->name('change_usertype');
	Route::post('/user/info', 'ManageController@user_info')->name('user_info');
	Route::post('/user/edit', 'ManageController@user_edit')->name('user_edit');
	Route::post('/user/delete', 'ManageController@delete_user')->name('delete_user');

	Route::get('/api', 'ApiManageController@index')->name('api');
	Route::get('/api/check', 'ApiManageController@checkApis')->name('api.check');
});

Route::get('/register', function(){
	return redirect('/');
});

Route::get('/register_nl', 'Auth\RegisterController@showRegistrationForm')->name('register_nl');
Route::post('/register_nl', 'Auth\RegisterController@register');



