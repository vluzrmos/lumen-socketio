## Lumen + Socket.io e Redis Broadcasting
[![Latest Stable Version](https://poser.pugx.org/vluzrmos/lumen-socketio/v/stable)](https://packagist.org/packages/vluzrmos/lumen-socketio) [![Total Downloads](https://poser.pugx.org/vluzrmos/lumen-socketio/downloads)](https://packagist.org/packages/vluzrmos/lumen-socketio) [![Latest Unstable Version](https://poser.pugx.org/vluzrmos/lumen-socketio/v/unstable)](https://packagist.org/packages/vluzrmos/lumen-socketio) [![License](https://poser.pugx.org/vluzrmos/lumen-socketio/license)](https://packagist.org/packages/vluzrmos/lumen-socketio)


## Instalation

```bash
composer require vluzrmos/lumen-socketio
```

Add the Services Providers, on <code>bootstrap/app.php</code>:
```php 
$app->register('Vluzrmos\Socketio\SocketioServiceProvider');
```

## Configuration

Install NodeJs dependencies:

```bash
npm install --save express http-server redis ioredis socket.io
```

Copy the file <code>vendor/vluzrmos/lumen-socketio/Vluzrmos/Socketio/socket.js</code> to your project root.

> Modify it whatever you want, see the code: [socket.js](https://github.com/vluzrmos/lumen-socketio/blob/master/src/Vluzrmos/Socketio/socket.js)

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
# that socket.js file is in your project root
node socket.js
```

On your Lumen App:
```php
$app->get('/publish', function() {
    publish('channel', 'awesome-event', 'An message');
    publish('channel', 'awesome-event', ['message' => 'An message', 'user' => \App\User::first()]);
});


//or, in your controller or some else method (using Dependency Injection)

public function publishSomethingAwesome(\Vluzrmos\Socketio\Contracts\Broadcast $broadcast){
    $broadcast->publish('channel', 'awesome-event', 'An message');
    
    // or just use the helper without inject \Vluzrmos\Socketio\Contracts\Broadcast
    
    publish('channel', 'awesome-event', 'An message');
}

```

And finish, run your lumen app:

```bash
php artisan serve
```
