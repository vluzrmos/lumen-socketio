<?php

namespace Vluzrmos\Socketio;

use Illuminate\Redis\Database;
use Illuminate\Support\ServiceProvider;

class SocketioServiceProvider extends ServiceProvider{
    protected $defer = false;

    public function register(){
        $this->app->configure('database');

        $this->app->singleton('Illuminate\Contracts\Redis\Database', function(){
            return new Database($this->app['config']['database.redis']);
        });

        $this->app->singleton('Vluzrmos\Socketio\Contracts\Broadcast', function(){
            return new Broadcast(app('Illuminate\Contracts\Redis\Database'));
        });
    }
}
