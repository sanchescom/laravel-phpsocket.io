<?php

namespace Sanchescom\LaravelSocketIO\Test;

use Illuminate\Contracts\Foundation\Application as ApplicationInterface;
use Mockery;
use PHPSocketIO\SocketIO;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Sanchescom\LaravelSocketIO\Sockets\AbstractSocket;
use Sanchescom\LaravelSocketIO\SocketServiceProvider;

class SocketServiceProviderTest extends BaseTestCase
{
    /**
     * @var Mockery\MockInterface
     */
    protected $app;

    /**
     * @var AbstractSocket
     */
    protected $handler;

    /**
     * @var SocketIO
     */
    protected $socket;

    /**
     * @var SocketServiceProvider
     */
    protected $provider;


    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = Mockery::mock(AbstractSocket::class);
        $this->socket = Mockery::mock(SocketIO::class);
        $this->app = Mockery::mock(ApplicationInterface::class);

        $this->app->shouldReceive('make')
            ->with(AbstractSocket::class)
            ->andReturn($this->handler);

        $this->app->shouldReceive('make')
            ->with(SocketIO::class, [
                'port' => 2020,
                'opts' => [],
            ])
            ->andReturn($this->socket);

        /* @var ApplicationInterface $app */
        $app = $this->app;

        $this->provider = new SocketServiceProvider($app);
    }

    /**
     * @test
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function it_should_return_true_in_booting()
    {
        $this->assertTrue($this->provider->boot());
    }

    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function it_should_return_abstract_handler_with_making_socket()
    {
        $method = $this->getMethod('makeSocketHandler');
        $socketHandler = $method->invokeArgs($this->provider, [$this->handler]);

        $this->assertInstanceOf(AbstractSocket::class, $socketHandler);
    }

    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function it_should_return_socket_io_with_making_socket()
    {
        $method = $this->getMethod('makeSocket');
        $socket = $method->invokeArgs($this->provider, [2020, []]);

        $this->assertInstanceOf(SocketIO::class, $socket);
    }

    /**
     * @param string $name
     *
     * @throws ReflectionException
     *
     * @return ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass(SocketServiceProvider::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
