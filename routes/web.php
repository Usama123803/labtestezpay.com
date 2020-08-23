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
Route::post('storePatient','HomeController@storePatient')->name('store.patient');
Route::get('/patient/print-pdf/{id}', 'HomeController@printPdf')->name('generate.pdf');
Route::get('/patient/send-email/{id}', 'HomeController@patientEmail')->name('patient.email');
