<?php
namespace Rishadblack\Laraform;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class LaraformServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (class_exists(AboutCommand::class) && class_exists(\Composer\InstalledVersions::class)) {
            AboutCommand::add('Laraform', [
                'Version' => 'v' . \Composer\InstalledVersions::getPrettyVersion('rishadblack/laraform'),
            ]);
        }

        // Load translations if needed
        // $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'laraform');

        // Load migrations if needed
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Load routes if needed
        // $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge configuration file if available
        $this->mergeConfigFrom(__DIR__ . '/../config/laraform.php', 'laraform');

        // Register package services in the container
        $this->app->singleton('laraform', function ($app) {
            return new Laraform();
        });

        // Load views from the package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laraform');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraform'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing configuration file
        $this->publishes([
            __DIR__ . '/../config/laraform.php' => config_path('laraform.php'),
        ], 'laraform.config');

        // Publishing views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laraform'),
        ], 'laraform.views');

        // Publishing assets if needed
        // $this->publishes([
        // __DIR__ . '/../resources/assets' => public_path('vendor/laraform'),
        // ], 'laraform.assets');

        // Publishing language files if needed
        // $this->publishes([
        // __DIR__ . '/../resources/lang' => resource_path('lang/vendor/laraform'),
        // ], 'laraform.lang');
    }
}
