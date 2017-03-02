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

// Route::get('/search','FileController@search');

// Route::post('/results','FileController@SearchResults');

Route::get('/settings','SettingsController@index');

Route::patch('/settings','SettingsController@update');

Route::get('/changePassword','SettingsController@changePasswordForm');

Route::patch('/changePassword','SettingsController@changePassword');

Route::get('/AddFile','FileController@FileForm');

Route::post('/AddFile','FileController@AddFile');

Route::get('/logs','AdminController@showLogs');

Route::get('/users','AdminController@showUsers');

Route::get('/collections','CollectionsController@collections');

Route::get('/list','FileController@list');

Route::get('/increment_views', 'FileController@increment_views');

Route::patch('/lock','FileController@lock');

Route::patch('/unlock','FileController@unlock');

Route::get('/ArchivedFiles','AdminController@ArchivedFiles');

Route::get('/favorite','FileController@favorite');

Route::get('/bookmark','FileController@bookmark');

Route::patch('/LockUser','AdminController@LockUser');

Route::patch('/UnlockUser','AdminController@UnlockUser');

Route::patch('/PromoteUser','AdminController@PromoteUser');

Route::patch('/DemoteUser','AdminController@DemoteUser');

Route::post('/compress','FileController@compress');

// Route::post('/generate_temp','FileController@generate_temp');

Route::get('/getchartvd','HomeController@getchartvd');

Route::get('/getchartvm','HomeController@getchartvm');

Route::get('/getchartvy','HomeController@getchartvy');

Route::get('/getchartud','HomeController@getchartud');

Route::get('/getchartum','HomeController@getchartum');

Route::get('/getchartuy','HomeController@getchartuy');

Route::get('/getchartld','HomeController@getchartld');

Route::get('/getchartlm','HomeController@getchartlm');

Route::get('/getchartly','HomeController@getchartly');

Route::get('/InactiveUsers','AdminController@InactiveUsers');

Route::get('/profile','HomeController@Profile');

Route::get('/View_PDF','FileController@View_PDF');

Route::patch('/updateFile','FileController@updateFile');

Route::post('/addNotes','FileController@addNotes');

Route::patch('/editNotes','FileController@editNotes');

Route::post('/deleteNotes','FileController@deleteNotes');

Route::get('/collections/{Course}','CollectionsController@Course');