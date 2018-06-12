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
use App\Products;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'PagesController@home');
Route::get('/', 'PagesController@inventory');
Route::get('/salesorder', 'PagesController@salesorder');
Route::get('/transferrequest', 'PagesController@transferrequest');
Route::get('/user', 'PagesController@user');
Route::get('/staffsignup', 'UsersController@create');
Route::get('/outlet', 'PagesController@outlet');
Route::get('/salesrecord', 'PagesController@salesrecord');
Route::get('/product', 'PagesController@product');

Route::resource('home', 'HomeController');
Route::resource('inventory', 'InventoryController');
Route::resource('user', 'UsersController');
Route::resource('outlet', 'OutletsController');
Route::resource('transferrequest', 'TransferRequestController');
Route::resource('salesorder', 'SalesOrdersController');
Route::resource('salesrecord', 'SalesRecordsController');
Route::resource('product', 'ProductsController');

Route::get('/ajax/so_tbp/{$statuses_id}', 'SalesOrdersController@view');
Route::get('/ajax/so-tbs/{$statuses_id}', 'SalesOrdersController@getOutlet');
Route::get('/ajax/so-tbd/{$statuses_id}', 'SalesOrdersController@getOutlet');
Route::get('/ajax/so-tbi/{$statuses_id}', 'SalesOrdersController@getOutlet');
Route::get('/ajax/tr-tbp/{$statuses_id}', 'TransferRequestController@getOutlet');
Route::get('/ajax/tr-tbs/{$statuses_id}', 'TransferRequestController@getOutlet');
Route::get('/ajax/tr-tbd/{$statuses_id}', 'TransferRequestController@getOutlet');
Route::get('/ajax/tr-tbi/{$statuses_id}', 'TransferRequestController@getOutlet');

Auth::routes();

Route::get('/', 'InventoryController@index')->name('inventory');

//Inventory
Route::get('/ajax/outlet', 'InventoryController@getOutlet');
Route::get('/ajax/product_brand', 'InventoryController@getProductBrand');
Route::get('/ajax/inventory', 'InventoryController@getInventory');
Route::get('/autocomplete-search', 'InventoryController@search');
Route::get('/retrieve-inventory-by-outlet/{outlet}', 'InventoryController@getInventoryByOutlet');
Route::get('/retrieve-inventory-by-product-brand/{product_brand}', 'InventoryController@getInventoryByProductBrand');
Route::get('/retrieve-inventory-by-product-brand/for-wholesaler/{product_brand}', 'InventoryController@getInventoryByProductBrandforWholesaler');
Route::get('/retrieve-inventory-by-filter/{outlet}/{product_brand}', 'InventoryController@getInventoryByFilter');
Route::get('/retrieve-inventory-by-product-name/{productName}', 'InventoryController@getInventoryByProductName');
Route::get('export-inventory/{type}', 'InventoryController@exportFile')->name('exportInventory.file');

//SalesRecord 
Route::get('/salesrecord/create', 'SalesRecordsController@getSalesRecordCart');
Route::get('/salesrecord/addtocart/{id}/{price}/{quantity}/{outlet}/{date}/{remarks}', 'SalesRecordsController@getSalesRecordAddToCart');
Route::get('/testing/{id}', 'UsersController@show');
Route::get('export-salesrecord/{type}', 'SalesRecordsController@exportFile')->name('exportSalesRecord.file');
Route::get('/salesrecord/remove/{id}', 'SalesRecordsController@getRemoveItem');

//SalesOrder
Route::get('/salesorder/create', 'SalesOrdersController@getSalesOrderCart');
Route::get('/salesorder/addtocart/{id}/{quantity}/{unitPrice}/{date}/{remarks}', 'SalesOrdersController@getSalesOrderAddToCart');
Route::get('/testing/{id}', 'UsersController@show');
Route::get('/salesorder/remove/{id}', 'SalesOrdersController@getRemoveItem');
Route::get('export-salesorder/{type}', 'SalesOrdersController@exportFile')->name('exportSalesOrder.file');
Route::get('generate-SO/{salesOrders}', 'SalesOrdersController@generateSO')->name('generateSO.file');

//TransferRequest
Route::get('/transferrequest/create', 'TransferRequestController@getTransferRequestCart');
Route::get('/transferrequest/addtocart/{id}/{quantity}/{outlet}/{date}/{remarks}', 'TransferRequestController@getTransferRequestAddToCart');
Route::get('/testing/{id}', 'UsersController@show');
Route::get('/transferrequest/reduce/{id}', 'TransferRequestController@getReduceByOne');
Route::get('/transferrequest/remove/{id}', 'TransferRequestController@getRemoveItem');

//Accept/Reject Transfer Request
Route::post('/', function () {
    DB::table('things')->insert(request()->only('thing'));
});

//Users
Route::get('export-user/{type}', 'UsersController@exportFile')->name('exportUser.file');

//Outlets
Route::get('export-outlet/{type}', 'OutletsController@exportFile')->name('exportOutlet.file');
Route::get('outlets/check/{id}','OutletsController@checkIfUsersExist');

//Products
Route::get('/products/create', 'ProductsController@add');
Route::get('/autocompletesearch', 'InventoryController@search');