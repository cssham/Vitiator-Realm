<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/','FrontendController@index')->name('frontend.index');
/* Route::get('/', function () {
    return view('frontend/index');
}); */
Route::post('/reservation', 'ReservationController@reserve')->name('reservation');
Route::post('/contact', 'ContactController@contact')->name('contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>'auth'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('item', 'ItemController');
    Route::resource('slider','SliderController');
    Route::get('/reservation/list','ReservationController@index')->name('reservation.list');
    Route::post('/reservation/status/{id}', 'ReservationController@status')->name('reservation.status');
    Route::delete('/reservation/delete/{id}', 'ReservationController@delete')->name('reservation.delete');
    Route::get('/contact/list', 'ContactController@index')->name('contact.list');
    Route::delete('/contact/delete/{id}', 'ContactController@delete')->name('contact.delete');
});
