<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('patients', PatientController::class);
    $router->resource('locations', LocationController::class);

    $router->get('/patient/send-email/{id}', 'HomeController@patientEmail');
    $router->get('/patient/checkin/{id}', 'HomeController@patientCheckIn');

    $router->resource('configurations', ConfigurationController::class);

    $router->resource('admin-users', AdminUserController::class);

    $router->resource('covid-symptoms', CovidSymptomController::class);

    $router->resource('timesheets', TimesheetController::class);

});

