<?php

namespace Realevd\NovaCkeditor5;

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\App;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publish();
        }

        $this->mergeConfigFrom(__DIR__ . '/../config/nova-ckeditor5.php', 'nova-ckeditor5');
    }

    public function boot(): void
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::style('field-ckeditor5', __DIR__ . '/../dist/css/field.css');
            Nova::script('field-ckeditor5', __DIR__ . '/../dist/js/field.js');
            $lang = config('nova-ckeditor5.lang');
            if ($lang !== 'en') {
                Nova::script('field-ckeditor5-' . $lang, __DIR__ . '/../dist/translations/' . $lang . '.js');
            }
        });
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../config/nova-ckeditor5.php' => config_path('nova-ckeditor5.php')
        ], 'nova-ckeditor5-config');
    }

    /**
     * Register routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/nova-ckeditor5')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
