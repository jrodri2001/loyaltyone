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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('submission', 'SubmissionController@index');
Route::get('submission/{id}', 'SubmissionController@show');
Route::get('submission/view/{id}', 'SubmissionController@view');
Route::get('submission/username/{user}', 'SubmissionController@indexByUser');
Route::post('submission', 'SubmissionController@store');
Route::put('submission/{id}', 'SubmissionController@update');
Route::delete('submission/{id}', 'SubmissionController@delete');