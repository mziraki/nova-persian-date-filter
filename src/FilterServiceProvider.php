<?php

namespace MZiraki\PersianDateFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('persian-date-filter', __DIR__ . '/../dist/js/filter.js');
            Nova::style('persian-date-filter', __DIR__ . '/../dist/css/filter.css');
        });
    }
}
