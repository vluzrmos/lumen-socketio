<?php

if(!function_exists('publish')){

    /**
     * Publish something to a channel
     * @param String $channel Channel name
     * @param String $event Event name
     * @param String|Array|Serializable $message the message
     * @return mixed
     */
    function publish($channel, $event, $message)
    {
        return app('Vluzrmos\Socketio\Contracts\Broadcast')->publish($channel, $event, $message);
    }
}
