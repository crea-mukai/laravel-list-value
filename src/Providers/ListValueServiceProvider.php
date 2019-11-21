<?php

namespace CreaMukai\LaravelListValue\Providers;

use App\Services\ListValueService;
use Illuminate\Support\ServiceProvider;

class ListValueServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            // __DIR__.'/../config/list_value.php' => config_path('list_value.php'),
            __DIR__.'/../ListValue/' => app_path('Model/ListValue'),
            __DIR__.'/../Services/ListValueService.php' => app_path('Services/ListValueService.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('ListValueService', ListValueService::class);
        // $this->app->bind('listValueService', ListValueService::class);
        $this->app->singleton('ListValueService', function(){
            return new ListValueService();
        });
    }
}
