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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tickets', 'TicketController@index')->name('ticket');
    Route::get('/tickets/show/{uid}', 'TicketController@show')->name('ticket.show');
    Route::get('/tickets/create', 'TicketController@create')->name('ticket.create');
    Route::post('/tickets/store', 'TicketController@store')->name('ticket.store');
    Route::put('/tickets/close/{uid}', 'TicketController@update')->name('ticket.close');
});
