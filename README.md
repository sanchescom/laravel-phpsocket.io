[![Build Status](https://travis-ci.org/sanchescom/laravel-phpsocket.io.svg?branch=master)](https://travis-ci.org/sanchescom/laravel-phpsocket.io)
[![codecov](https://codecov.io/gh/sanchescom/laravel-phpsocket.io/branch/master/graph/badge.svg)](https://codecov.io/gh/sanchescom/laravel-phpsocket.io)
[![Maintainability](https://api.codeclimate.com/v1/badges/852384730259754d4008/maintainability)](https://codeclimate.com/github/sanchescom/laravel-phpsocket.io/maintainability)
[![StyleCI](https://github.styleci.io/repos/175257648/shield?branch=master)](https://github.styleci.io/repos/175257648)
[![Quality Score](https://img.shields.io/scrutinizer/g/sanchescom/laravel-phpsocket.io.svg?style=flat-square)](https://scrutinizer-ci.com/g/sanchescom/laravel-phpsocket.io)
# Laravel with phpsocket.io

This is Laravel package for phpsocket.io which is a server side alternative implementation of socket.io in PHP based on Workerman.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require sanchescom/laravel-phpsocket.io
```

Create `SocketServiceProvider.php` in `app/Providers`

``` php
<?php

namespace App\Providers;

use Sanchescom\LaravelSocketIO\SocketServiceProvider as ServiceProvider;
use App\Sockets\ExampleSocket;

/**
 * Class SocketServiceProvider.
 */
class SocketServiceProvider extends ServiceProvider
{
    /**
     * The socket handlers for the application.
     *
     * @var array
     */
    protected $sockets = [
        ExampleSocket::class,
    ];
}
```

### Laravel 5.x:

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

 ```php
'providers' => [
    ...
    App\Providers\SocketServiceProvider::class,
],
```

### Lumen:

After updating composer add the following lines to register provider in `bootstrap/app.php`

```php
$app->register(App\Providers\SocketServiceProvider::class);
```
  
## Usage

Create folder `app\Sockets` and put there `ExampleSocket.php`

``` php
<?php

namespace App\Sockets;

use PHPSocketIO\SocketIO;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;
use Workerman\Lib\Timer;

class ExampleSocket extends AbstractSocket
{
    /**
     * @var int
     */
    const TIME_INTERVAL = 4;

    /**
     * @var int
     */
    protected $port = 2020;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param SocketIO $socketIO
     */
    public function call(SocketIO $socketIO): void
    {
        $socketIO->on('workerStart', function () use ($socketIO) {
            Timer::add(self::TIME_INTERVAL, function () use ($socketIO) {
                $socketIO->to('room')->emit('score', [
                    'items' => [
                        [
                            'id' => 1,
                            'message' => 'Hello world'
                        ],
                    ]
                ]);
            });
        });

        $socketIO->on('connection', function ($socket) {
            $socket->join('room');
        });
    }
}
```

## Running

### Start
```bash
$ ./vendor/bin/socket start
```

### Stop:
```bash
$ ./vendor/bin/socket stop
```

### Status
```bash
$ ./vendor/bin/socket status
```

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/sanchescom/laravel-phpsocket.io/tags). 

## Authors

* **Efimov Aleksandr** - *Initial work* - [Sanchescom](https://github.com/sanchescom)

See also the list of [contributors](https://github.com/sanchescom/laravel-phpsocket.io/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

