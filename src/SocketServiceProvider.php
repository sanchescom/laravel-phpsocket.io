<?php

namespace Sanchescom\LaravelSocketIO;

use Illuminate\Support\ServiceProvider;
use PHPSocketIO\SocketIO;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;

/**
 * Class SocketServiceProvider.
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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return bool
     */
    public function boot(): bool
    {
        foreach ($this->sockets as $handler) {
            // @codeCoverageIgnoreStart
            $socketHandler = $this->makeSocketHandler($handler);
            $socketHandler->call(
                $this->makeSocket(
                    $socketHandler->getPort(),
                    $socketHandler->getOptions()
                )
            );
            // @codeCoverageIgnoreEnd
        }

        return true;
    }

    /**
     * Make socket handler instance.
     *
     * @param string $handler
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return AbstractSocket
     */
    protected function makeSocketHandler($handler): AbstractSocket
    {
        return $this->app->make($handler);
    }

    /**
     * Make socket instance.
     *
     * @param int   $port
     * @param array $options
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
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
