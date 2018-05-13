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
Route::get('/home', 'PagesController@home');
Route::get('/', 'PagesController@inventory');
Route::get('/salesorder', 'PagesController@salesorder');
Route::get('/transferrequest', 'PagesController@transferrequest');
Route::get('/user', 'PagesController@user');
Route::get('/staffsignup', 'UsersController@create');
Route::get('/outlet', 'PagesController@outlet');
Route::get('/salesrecord', 'PagesController@salesrecord');

Route::resource('home', 'HomeController');
Route::resource('inventory', 'InventoryController');
Route::resource('user', 'UsersController');
Route::resource('outlet', 'OutletsController');
Route::resource('transferrequest', 'TransferRequestController');
Route::resource('salesorder', 'SalesOrdersController');
Route::resource('salesrecord', 'SalesRecordsController');

Auth::routes();

Route::get('/', 'InventoryController@index')->name('inventory');

//Inventory
Route::get('/ajax/inventory', 'InventoryController@getInventory');
Route::get('/ajax/inventory/{id}', 'InventoryController@getInventoryById');
Route::get('/autocomplete-search', 'InventoryController@search');
Route::get('/retrieve-inventory-by-outlet/{outlet}', 'InventoryController@getInventoryByOutlet');
Route::get('/retrieve-inventory-by-product-name/{productName}', 'InventoryController@getInventoryByProductName');
Route::post('import-inventory', 'InventoryController@importFile')->name('import.file');
Route::get('export-inventory/{type}', 'InventoryController@exportFile')->name('export.file');

//Retrieve Outlets
Route::get('/ajax/outlet', 'InventoryController@getOutlet');
Route::get('/ajax/inventory-outlet', 'InventoryController@getOutletByInventory');

//Import outlets
// Route::get('import-export-view', 'ExcelController@importExportView')->name('import.export.view');

//SalesRecord 
Route::get('/salesrecord/create', 'SalesRecordsController@getSalesRecordCart');
Route::get('/salesrecord/addtocart/{id}', 'SalesRecordsController@getSalesRecordAddToCart');
Route::get('/testing/{id}', 'UsersController@show');

//SalesOrder
Route::get('/salesOrder/create', 'SalesOrdersController@getSalesOrderCart');
Route::get('/salesOrder/addtocart/{id}', 'SalesOrdersController@getSalesOrderAddToCart');
Route::get('/testing/{id}', 'UsersController@show');