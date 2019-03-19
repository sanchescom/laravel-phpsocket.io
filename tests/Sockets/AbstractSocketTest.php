<?php

namespace Sanchescom\LaravelSocketIO\Test\Sockets;

use ReflectionClass;
use ReflectionException;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;
use Sanchescom\LaravelSocketIO\Test\BaseTestCase;

/**
 * Class AbstractSocketTest
 */
class AbstractSocketTest extends BaseTestCase
{
    /**
     * @var AbstractSocket
     */
    protected $handler;


    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function it_should_return_a_number_for_port()
    {
        $stub = $this->getMockForAbstractClass(AbstractSocket::class);
        $stub->expects($this->any())
            ->method('call');

        $this->setProperty($stub, 'port', 2020);

        /* @var AbstractSocket $stub */
        $this->assertIsInt($stub->getPort());
    }


    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function it_should_return_an_array_for_options()
    {
        $stub = $this->getMockForAbstractClass(AbstractSocket::class);
        $stub->expects($this->any())
            ->method('call');

        $this->setProperty($stub, 'options', []);

        /* @var AbstractSocket $stub */
        $this->assertIsArray($stub->getOptions());
    }

    /**
     * @param $stub
     * @param $name
     * @param $value
     *
     * @throws ReflectionException
     *
     * @return void
     */
    protected function setProperty($stub, $name, $value)
    {
        $class = new ReflectionClass($stub);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        $property->setValue($stub, $value);
    }
}
