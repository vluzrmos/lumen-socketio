## Lumen + Socket.io e Redis Broadcasting

## Instalation

```bash
composer require vluzrmos/lumen-socketio
```

## Configuration

Install NodeJs dependencies:

```bash
npm install --save express http-server redis ioredis socket.io
```

Just create a nodejs file to your socket.io server, i will name it <code>socket.js</code>:

```javascript
var app  = require('express');
var http = require('http').Server(app);
var io   = require('socket.io')(http);

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

```
> Obs.: Remember to install a [Redis Server](http://redis.io)

On your view, you have to use [socket.io.js](http://socket.io/download/)

```html
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Lumen Socket.IO </title>
    <script src="//cdn.socket.io/socket.io-1.3.5.js"></script>
</head>
<body>

    <script type="text/javascript">
        var socket = io('http://localhost:8080'); //Some host and port configured in socket.js

        socket.on('channel:awesome-event', function (data) {
            console.log(data);
        });
    </script>
</body>
</html>
```

## Usage

Run your socket.io server:

```bash
node socket.js
```

On your Lumen App:
```php

publish('channel', 'awesome-event', 'An message');

publish('channel', 'awesome-event', ['message' => 'An message', 'user' => \App\User::first()]);

```

And finish, run your lumen app:

```bash
php artisan serve
```
