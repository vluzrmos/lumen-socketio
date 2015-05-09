<?php

namespace Vluzrmos\Socketio;
use Illuminate\Contracts\Redis\Database as Redis;

class Broadcast implements Contracts\Broadcast{

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
     * Publish a message to a channel
     * @param String $channel Channel name
     * @param String $event Event name
     * @param String|Array|Serializable $message the message
     * @return mixed
     */
    public function publish($channel, $event, $message){
        return $this->redis->publish($channel, json_encode([
            'event' => $event,
            'payload' => $message
        ]));
    }
}
