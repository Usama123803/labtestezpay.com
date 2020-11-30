<?php

namespace App\Providers;

use App\Configuration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $values = Configuration::where('id', 1)->first();
        config([
            'site' => [
                'start_time'       => $values->start_time,
                'end_time'         => $values->end_time,
                'time_interval'    => $values->time_interval,
                'block_limit'      => $values->block_limit,
                'disabled_appointment_dates'      => $values->disabled_appointment_dates,
                'block_start_time'      => $values->block_start_time,
                'block_end_time'      => $values->block_end_time
            ]
        ]);

    }
}
