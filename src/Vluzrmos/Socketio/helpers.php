<?php

if(!function_exists('publish')){
    function publish($channel, $event, $message)
    {
        return app('broadcast')->publish($channel, $event, $message);
    }
}
