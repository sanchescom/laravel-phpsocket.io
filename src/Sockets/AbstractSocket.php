<?php

namespace Sanchescom\LaravelSocketIO\Sockets;

use PHPSocketIO\SocketIO;

abstract class AbstractSocket
{
    /**
     * @param SocketIO $socketIO
     */
    abstract public function call(SocketIO $socketIO);
}
