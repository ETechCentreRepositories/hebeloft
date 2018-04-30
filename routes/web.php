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
Route::get('/transferrequest', 'PagesController@transferrequest');
Route::get('/user', 'PagesController@user');
Route::get('/staffsignup', 'UsersController@create');
Route::get('/outlet', 'PagesController@outlet');
Route::get('/salesrecord', 'PagesController@salesrecord');

Route::resource('user', 'UsersController');
Route::resource('outlet', 'OutletsController');
Route::resource('transferrequest', 'TransferRequestsController');
Route::resource('salesorder', 'SalesOrdersController');
Route::resource('salesrecord', 'SalesRecordsController');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Inventory
Route::resource('inventory', 'InventoryController');
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
Route::get('/salesrecord/create', 'SalesRecordController@create');
Route::get('/salesrecord/addSalesRecordList/{productName}', 'SalesRecordController@addSalesRecordList');
Route::get('/salesrecord/retrieveItemBySalesId/{salesRecordId}', 'SalesRecordController@retrieveItemBySalesId');
Route::get('/retrieve-add-inventory-by-product-name/{productName}', 'SalesRecordController@getInventoryByProductName');
Route::get('/salesrecord/addtocart',[
    'uses' => 'SalesRecordController@getSalesRecordAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('salesrecord/retrieveitemBySalesId/{salesRecordId}', 'SalesRecordController@retieveItemBySalesId');
