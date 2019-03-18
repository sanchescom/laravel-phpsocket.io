<?php

namespace Sanchescom\LaravelSocketIO\Sockets;

use PHPSocketIO\SocketIO;

/**
 * Class AbstractSocket
 * @package Sanchescom\LaravelSocketIO\Sockets
 */
abstract class AbstractSocket
{
    /**
     * Listening port
     *
     * @var int
     */
    protected $port;

    /**
     * Addition options
     *
     * @var array
     */
    protected $options;


    /**
     * @param SocketIO $socketIO
     * @return void
     */
    abstract public function call(SocketIO $socketIO): void;

    /**
     * Getting socket port
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Getting socket options
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
