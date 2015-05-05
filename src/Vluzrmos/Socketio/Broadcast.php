<?php

namespace Vluzrmos\Socketio;

class Broadcast {

    /**
     * @var \Redis;
     */
    protected $redis;

    /**
     * @param $redis
     */
    public function __construct($redis = null){
        if(!$redis){
            $redis = app('redis');
        }

        $this->redis = $redis;
    }

    /**
     * @param $channel
     * @param $event
     * @param $message
     * @return int
     */
    public function publish($channel, $event, $message){
        return $this->redis->publish($channel, json_encode([
            'event' => $event,
            'payload' => $message
        ]));
    }
}
