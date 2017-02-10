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

Route::get('/', 'HomeController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/search','FileController@search');

Route::post('/results','FileController@SearchResults');

Route::get('/settings','SettingsController@index');

Route::patch('/settings','SettingsController@update');

Route::get('/AddFile','FileController@FileForm');

Route::post('/AddFile','FileController@AddFile');

Route::get('/logs','AdminController@showLogs');

Route::get('/users','AdminController@showUsers');

Route::get('/collections','FileController@collections');

Route::get('/list','FileController@list');

Route::post('/increment_views', 'FileController@increment_views');

Route::patch('/lock','FileController@lock');

Route::patch('/unlock','FileController@unlock');

Route::get('/ArchivedFiles','AdminController@ArchivedFiles');

Route::post('/favorite','FileController@favorite');

Route::post('/bookmark','FileController@bookmark');

Route::patch('/LockUser','AdminController@LockUser');

Route::patch('/UnlockUser','AdminController@UnlockUser');

Route::patch('/PromoteUser','AdminController@PromoteUser');

Route::patch('/DemoteUser','AdminController@DemoteUser');

Route::post('/compress','FileController@compress');

Route::post('/generate_temp','FileController@generate_temp');

Route::get('/encrypted_data?{data}','FileController@encypted_data');