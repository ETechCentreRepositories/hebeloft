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

<<<<<<< HEAD
Route::get('/', function () {
    return view('auth.login');
});
=======
Route::get('/', 'PagesController@home');
Route::get('/stafftable', 'PagesController@stafftable');
Route::get('/staffsignup', 'PagesController@staffsignup');
>>>>>>> ad00cc0375478775c6c12be78fda0c9de67d9497

Route::resource('stafftable', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
