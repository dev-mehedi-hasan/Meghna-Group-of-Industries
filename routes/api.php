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
Route::get('ticket-chart', 'GetChartDataController@getMonthlyTicketData')->name('api.ticketChart');
Route::get('crm-chart', 'GetChartDataController@getMonthlyCrmData')->name('api.crmChart');
Route::post('ticket-by-ajax', 'api\GetTicketByAjaxController@getTicket')->name('api.ticketByAjax');
Route::post('ticket-by-ajax-by-id', 'api\GetTicketByAjaxController@getTicketById')->name('api.ticketByAjaxByID');
Route::post('ticket-close-by-ajax', 'api\GetTicketByAjaxController@ticketCloseById')->name('api.ticketCloseByAjax');

Route::get('crm-create', 'api\CrmController@create')->name('crmapi.create');
Route::get('get-crm-data', 'api\CrmController@getData')->name('crmapi.index');
Route::post('crm-store', 'api\CrmController@store')->name('crmapi.store');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
