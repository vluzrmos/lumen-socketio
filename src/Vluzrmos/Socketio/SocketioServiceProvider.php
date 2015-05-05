<?php

namespace Vluzrmos\Socketio;

use Illuminate\Support\ServiceProvider;

class SocketioServiceProvider extends ServiceProvider{


    public function register(){
        $this->app->singleton('broadcast', function(){
            return new Broadcast(app('redis'));
        });

    }
}
