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

Route::get('/', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/customers', 'CustomerController@index');
Route::get('/customers', array("as" => "customers", 'uses' => 'CustomerController@index'));

Route::get('/addCustomer', array("as" => "addcustomer", 'uses' => 'CustomerController@addCustomer'));
Route::get('/searchCustomer', array("as" => "searchcustomer", 'uses' => 'CustomerController@searchCustomer'));

