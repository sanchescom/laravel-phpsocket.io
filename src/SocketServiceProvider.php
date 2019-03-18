<?php

namespace Sanchescom\LaravelSocketIO;

use Illuminate\Support\ServiceProvider;
use PHPSocketIO\SocketIO;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;

/**
 * Class SocketServiceProvider
 * @package Sanchescom\LaravelSocketIO
 */
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
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(): bool
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

        return true;
    }

    /**
     * Make socket handler instance
     *
     * @param string $handler
     * @return AbstractSocket
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function makeSocketHandler($handler): AbstractSocket
    {
        return $this->app->make($handler);
    }

    /**
     * Make socket instance
     *
     * @param int $port
     * @param array $options
     * @return SocketIO
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function makeSocket(int $port, array $options = []): SocketIO
    {
        return $this->app->make(SocketIO::class, [
            'port' => $port,
            'opts' => $options,
        ]);
    }
}
