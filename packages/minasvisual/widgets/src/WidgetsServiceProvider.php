<?php

namespace Minasvisual\Widgets;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class WidgetsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        public function register() {
        $this->app->singleton('PJConstants', function() {
            return new Constants;
        });
    }
    }

    
}
