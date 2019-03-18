<?php

namespace Sanchescom\LaravelSocketIO\Test\Sockets;

use ReflectionClass;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;
use Sanchescom\LaravelSocketIO\Test\BaseTestCase;

class AbstractSocketTest extends BaseTestCase
{
    /**
     * @var AbstractSocket
     */
    protected $handler;


    /**
     * Test getPort method.
     * @throws \ReflectionException
     */
    public function testGetPort()
    {
        $stub = $this->getMockForAbstractClass(AbstractSocket::class);
        $stub->expects($this->any())
            ->method('call');

        $this->setProperty($stub, 'port', 2020);

        /** @var AbstractSocket $stub */
        $this->assertIsInt($stub->getPort());
    }


    /**
     * Test getPort method.
     * @throws \ReflectionException
     */
    public function testGetOptions()
    {
        $stub = $this->getMockForAbstractClass(AbstractSocket::class);
        $stub->expects($this->any())
            ->method('call');

        $this->setProperty($stub, 'options', []);

        /** @var AbstractSocket $stub */
        $this->assertIsArray($stub->getOptions());
    }

    /**
     * @param $stub
     * @param $name
     * @param $value
     * @return void
     * @throws \ReflectionException
     */
    protected function setProperty($stub, $name, $value)
    {
        $class = new ReflectionClass($stub);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        $property->setValue($stub, $value);
    }
}