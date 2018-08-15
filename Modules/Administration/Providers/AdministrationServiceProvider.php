<?php

namespace Modules\Administration\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Joselfonseca\LaravelTactician\Bus as CommandBus;

class AdministrationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var array
     */
    protected $commandsHandlersForTesting = [
        'Modules\Administration\Commands\IndexUser'   => 'Modules\Administration\Tests\Commands\StubJsonCommandHandler',
        'Modules\Administration\Commands\StoreUser'   => 'Modules\Administration\Tests\Commands\StubJsonShowCommandHandler',
        'Modules\Administration\Commands\ShowUser'    => 'Modules\Administration\Tests\Commands\StubJsonShowCommandHandler',
        'Modules\Administration\Commands\UpdateUser'  => 'Modules\Administration\Tests\Commands\StubJsonCommandHandler',
        'Modules\Administration\Commands\DestroyUser' => 'Modules\Administration\Tests\Commands\StubJsonCommandHandler',
    ];

    protected $commandsHandlers = [
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();

        // According to https://gist.github.com/joselfonseca/c53132658f74419060065c13846e7c06#file-busserviceprovider2-php
        $this->registerCommandsHandlerBindings();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //echo 'Se ha llamado a register() de AppServiceProvider: '.$this->app->environment().PHP_EOL;

        //$this->registerCommandsHandlerBindings();

        /**/

        /*$this->app->when('Modules\Administration\Http\Controllers')
            ->needs('$who')
            ->give($this->app->make('SomeInterface'));*/
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('administration.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'administration'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/administration');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/administration';
        }, \Config::get('view.paths')), [$sourcePath]), 'administration');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/administration');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'administration');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'administration');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function registerCommandsHandlerBindings(){
        if( $this->app->environment() === 'testing' ){ // TODO: Move to phpunit's App bootstrap
            $this->registerUserRepositoryForTesting();
            $commandsHandlers = $this->commandsHandlersForTesting;
        }else{
            $this->registerUserRepository();
            $commandsHandlers = $this->commandsHandlers;
        }

        $this->app->singleton('AdminCommandBus',
                function (\Illuminate\Contracts\Foundation\Application $app) use ($commandsHandlers) {
                    $bus = $app->make(CommandBus::class);
                    foreach($commandsHandlers as $command => $handler) {
                        $bus->addHandler($command, $handler);
                    }
                    return $bus;
        });
    }

    private function registerUserRepositoryForTesting(){
        $this->app->bind('Modules\Administration\Repositories\Repository',
            'Modules\Administration\Repositories\ArrayRepository\User');
    }

    private function registerUserRepository(){
        $this->app->bind('Modules\Administration\Repositories\Repository',
            'Modules\Administration\Repositories\Eloquent\User');
    }
}
