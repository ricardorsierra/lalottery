<?php

namespace Ricardorsierra\Lalottery;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Ricardorsierra\Lalottery\Providers\LalotteryEventServiceProvider;
use Ricardorsierra\Lalottery\Providers\LalotteryModuleProvider;
use Ricardorsierra\Lalottery\Providers\LalotteryRouteProvider;
use Ricardorsierra\Lalottery\Providers\LalotteryServiceProvider;

class LalotteryProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $this->publishes(
            [
            __DIR__.'/PublishedAssets/Config' => base_path('config'),
            ]
        );

        $this->publishes(
            [
            __DIR__.'/Views' => base_path('resources/views/vendor/Lalottery'),
            ], 'backend'
        );

        $this->loadTranslationsFrom(__DIR__.'/Lang', 'Lalottery');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $theme = Config::get('Lalottery.frontend-theme', 'default');

        $this->loadViewsFrom(__DIR__.'/Views', 'Lalottery');

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive(
            'lalottery', function () {
                return '<?php echo Lalottery::moduleLinks(); ?>';
            }
        );
    }

    /**
     * Register the services.
     */
    public function register()
    {

        /*
        |--------------------------------------------------------------------------
        | Register Services Providers
        |--------------------------------------------------------------------------
        */
        $this->app->register(LalotteryRouteProvider::class);

        /*
         * Laravel Console
         */
        if (env('APP_ENV') === 'local') {
            $this->app->register(\Laravel\Tinker\TinkerServiceProvider::class);
        }
    }
}
