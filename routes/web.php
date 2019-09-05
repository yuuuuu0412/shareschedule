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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/home', 'HomeController@index')->middleware('auth');
Route::post('/', 'HomeController@create')->middleware('auth');
Route::get('/group', 'GroupController@index')->middleware('auth');
//Route::get('/participantgroup', 'HomeController@participantgroup')->middleware('auth');
Route::get('/participant', 'ParticipantController@index')->middleware('auth');
Route::post('/participant', 'ParticipantController@create')->middleware('auth');
Auth::routes();

/*Route::group(['middleware' => 'auth'], function(){
  Route::get('/', 'HomeController@home')->middleware('auth');
});*/
