<?php

namespace Vluzrmos\Socketio;
use Illuminate\Contracts\Redis\Database as Redis;

class Broadcast {

    /**
     * @var \Redis;
     */
    protected $redis;

    /**
     * @param $redis
     */
    public function __construct(Redis $redis){
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
