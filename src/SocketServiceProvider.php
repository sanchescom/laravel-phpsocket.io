<?php

namespace Sanchescom\LaravelSocketIO;

use Illuminate\Support\ServiceProvider;
use PHPSocketIO\SocketIO;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;

class SocketServiceProvider extends ServiceProvider
{
    /**
     * List of sockets with port and additional settings.
     *
     * @var array
     */
    protected $sockets = [];


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->sockets as $handler => $props) {
            list($port, $options) = $props;

            /** @var SocketIO $socket */
            $socket = $this->app->make(SocketIO::class, [
                'port' => $port,
                'opts' => $options,
            ]);

            /** @var AbstractSocket $socketHandler */
            $socketHandler = $this->app->make($handler);
            $socketHandler->call($socket);
        }
    }
}
