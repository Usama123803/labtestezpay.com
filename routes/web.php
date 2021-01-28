<?php

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

Route::get('/','HomeController@index');
Route::get('/patient','HomeController@patient');
Route::post('storePatient','HomeController@storePatient')->name('store.patient');
Route::get('/patient/print-pdf/{id}', 'HomeController@printPdf')->name('generate.pdf');
Route::get('/appointment/date', 'HomeController@appointmentDate');
Route::get('/location', 'HomeController@locationById');
Route::get('/terms-and-condition', 'HomeController@termsAndCondition');
Route::get('/admin/checkin', 'TimesheetController@checkIn');
Route::get('/admin/checkout', 'TimesheetController@checkOut');
Route::get('/admin/breakin', 'TimesheetController@breakIn');
Route::get('/admin/breakout', 'TimesheetController@breakOut');
//Route::get('/patient/generate-sticker-pdf/{id}', 'HomeController@printStickerPdf')->name('generate.pdf');
Route::get('/dymo-printer', 'DymoprinterController@index');
Route::get('/shipping-label', 'DymoprinterController@labelXML');
