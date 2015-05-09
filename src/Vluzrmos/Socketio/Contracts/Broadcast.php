<?php

namespace Vluzrmos\Socketio\Contracts;

interface Broadcast{

    /**
     * Publish a message to a channel
     * @param String $channel Channel name
     * @param String $event Event name
     * @param String|Array|Serializable $message the message
     * @return mixed
     */
    public function publish($channel, $event, $message);
}
