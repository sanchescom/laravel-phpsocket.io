<?php

namespace Sanchescom\LaravelSocketIO\Sockets;

use PHPSocketIO\SocketIO;
use Workerman\Lib\Timer;

class ExampleSocket extends AbstractSocket
{
    const TIME_INTERVAL = 60;

    public function call(SocketIO $socketIO)
    {
        $socketIO->on('workerStart', function () use ($socketIO) {
            Timer::add(self::TIME_INTERVAL, function () use ($socketIO) {
                $socketIO->to('room')->emit('score', [
                    'data' => []
                ]);
            });
        });

        $socketIO->on('connection', function ($socket) {
            $socket->join('room');
        });
    }
}
