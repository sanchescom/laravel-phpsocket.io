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
        foreach ($this->sockets as $handler) {
            $socketHandler = $this->makeSocketHandler($handler);
            $socketHandler->call(
                $this->makeSocket(
                    $socketHandler->getPort(),
                    $socketHandler->getOptions()
                )
            );
        }
    }

    /**
     * Creating socket handler instance
     *
     * @param $handler
     * @return AbstractSocket
     */
    protected function makeSocketHandler($handler): AbstractSocket
    {
        return $this->app->make($handler);
    }

    /**
     * @param int $port
     * @param array $options
     * @return SocketIO
     */
    protected function makeSocket(int $port, array $options = []): SocketIO
    {
        return $this->app->make(SocketIO::class, [
            'port' => $port,
            'opts' => $options,
        ]);
    }
}
