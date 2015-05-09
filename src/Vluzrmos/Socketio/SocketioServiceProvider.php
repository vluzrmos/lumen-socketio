<?php

namespace Vluzrmos\Socketio;

use Illuminate\Redis\Database;
use Illuminate\Support\ServiceProvider;

class SocketioServiceProvider extends ServiceProvider{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register(){
        $this->configureDatabase();
        $this->registerSingletons();
    }

    /**
     * Lumen Compatibility - Force to load database configurations
     */
    public function configureDatabase(){
        if(str_contains($this->app->version(), "Lumen")){
            $this->app->configure('database');
        }
    }

    /**
     * Register app singletons
     */
    public function registerSingletons(){
        /**
         * Register a Redis Connection with configurations
         */
        $this->app->singleton('Illuminate\Contracts\Redis\Database', function(){
            return new Database($this->app['config']['database.redis']);
        });

        /**
         * Register a Broadcast Publisher with Redis Database
         */
        $this->app->singleton('Vluzrmos\Socketio\Contracts\Broadcast', function(){
            return new Broadcast($this->app['Illuminate\Contracts\Redis\Database']);
        });
    }
}
