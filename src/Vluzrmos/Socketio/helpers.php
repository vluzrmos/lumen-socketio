<?php

if(!function_exists('publish')){
    function publish($channel, $event, $message){
        return call_user_func_array([app('broadcast'), 'publish'], func_get_args());
    }
}
