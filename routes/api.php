<?php

use Illuminate\Http\Request;

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



Route::post('/employeeLogin', 'API\SecurityController@employeeLogin')->name('employeeLogin');
Route::get('/getPendingOrder/{companyID}', 'API\OrderController@getPendingOrder')->name('getPendingOrder');
Route::get('/userDetail/{employeeId}', 'API\UserController@userDetail')->name('userDetail');
Route::post('/editProfile', 'API\UserController@editProfile')->name('editProfile');



Route::post('/saveBreakfastQty', 'API\CustomerOrder@save')->name('saveBreakfastQty');
Route::post('/saveBreakFast', 'API\CustomerOrder@saveBreakFast')->name('saveBreakFast');
Route::post('/saveLunchQty', 'API\CustomerOrder@saveLunchQty')->name('saveLunchQty');
Route::post('/saveLunch', 'API\CustomerOrder@saveLunch')->name('saveLunch');

Route::post('/saveDinnerQty', 'API\CustomerOrder@saveDinnerQty')->name('saveDinnerQty');
Route::post('/saveDinner', 'API\CustomerOrder@saveDinner')->name('saveDinner');
Route::get('/getCompletedOrders/{employeeId}', 'API\CustomerOrder@getCompletedOrders')->name('getCompletedOrders');
Route::get('/getCustomerFeedback/{employeeId}', 'API\CustomerOrder@getCustomerFeedback')->name('getCustomerFeedback');

Route::post('/checkBQty', 'API\CustomerOrder@checkBQty')->name('checkBQty');
Route::post('/checkLunchQty', 'API\CustomerOrder@checkLunchQty')->name('checkLunchQty');
Route::post('/checkDinnerQty', 'API\CustomerOrder@checkDinnerQty')->name('checkDinnerQty');
Route::post('/viewProducts', 'API\CustomerOrder@viewProducts')->name('viewProducts');


Route::post('/orderTtracking', 'API\CustomerOrder@orderTtracking')->name('orderTtracking');
Route::get('/completedOrder/{productId}', 'API\CustomerOrder@completedOrder')->name('completedOrder');








