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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/', 'PagesController@home');
Route::get('/', 'PagesController@home');
Route::get('/salesorder', 'PagesController@salesorder');
Route::get('/user', 'PagesController@user');
Route::get('/staffsignup', 'UsersController@create');
Route::get('/outlet', 'PagesController@outlet');
Route::get('/salesrecord', 'PagesController@salesrecord');

Route::resource('user', 'UsersController');
Route::resource('inventory', 'InventoryController');
Route::resource('outlet', 'OutletsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ajax/inventory', 'InventoryController@getInventory');
Route::get('/ajax/inventory/{id}', 'InventoryController@getInventoryById');

//Import outlets
// Route::get('import-export-view', 'ExcelController@importExportView')->name('import.export.view');

Route::post('import-inventory', 'InventoryController@importFile')->name('import.file');

Route::get('export-inventory/{type}', 'InventoryController@exportFile')->name('export.file');
