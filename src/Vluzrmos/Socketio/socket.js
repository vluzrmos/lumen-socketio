var app   = require('express');
var http  = require('http').Server(app);
var io    = require('socket.io')(http);
var Redis = require('ioredis');

/*
 * Your Redis connection
 * @see https://www.npmjs.com/package/ioredis for more details
 */
var redis = new Redis('redis://127.0.0.1:6379/0'); 

/**
 * Your broadcasting channel
 */
redis.subscribe('channel', function(err, count){

});

/*
 * Your broadcasting emitter
 */
redis.on('message', function(channel, message){
	message = JSON.parse(message);

	io.emit(channel+':'+message.event, message.payload);
});

/*
 * http server listen 8080
 */
http.listen(8080, function(){
	console.log('Listen on 0.0.0.0:8080');
});