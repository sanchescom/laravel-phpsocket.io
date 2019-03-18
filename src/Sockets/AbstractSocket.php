<?php

namespace Sanchescom\LaravelSocketIO\Sockets;

use PHPSocketIO\SocketIO;

abstract class AbstractSocket
{
    /**
     * @var int
     */
    protected $port;

    /**
     * @var array
     */
    protected $options;


    /**
     * @param SocketIO $socketIO
     */
    abstract public function call(SocketIO $socketIO);

    /**
     * Getting socket port
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Getting socket options
     */
    public function getOptions()
    {
        return $this->options;
    }
}
