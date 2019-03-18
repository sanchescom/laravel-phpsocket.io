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
        $this->socket  = Mockery::mock(SocketIO::class);
        $this->app     = Mockery::mock(ApplicationInterface::class);

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->app->shouldReceive('make')
            ->with(AbstractSocket::class)
            ->andReturn($this->handler);

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->app->shouldReceive('make')
            ->with(SocketIO::class, [
                'port' => 2020,
                'opts' => [],
            ])
            ->andReturn($this->socket);

        /** @var ApplicationInterface $app */
        $app = $this->app;

        $this->provider = new SocketServiceProvider($app);
    }

    /**
     * Test boot provider.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testBoot()
    {
        $this->assertTrue($this->provider->boot());
    }

    /**
     * Test makeSocketHandler method.
     * @throws ReflectionException
     */
    public function testMakeSocketHandler()
    {
        $method = $this->getMethod('makeSocketHandler');
        $socketHandler = $method->invokeArgs($this->provider, [$this->handler]);

        $this->assertInstanceOf(AbstractSocket::class, $socketHandler);
    }

    /**
     * Test makeSocket method.
     * @throws ReflectionException
     */
    public function testMakeSocket()
    {
        $method = $this->getMethod('makeSocket');
        $socket = $method->invokeArgs($this->provider, [2020, []]);

        $this->assertInstanceOf(SocketIO::class, $socket);
    }

    /**
     * @param string $name
     * @return ReflectionMethod
     * @throws ReflectionException
     */
    protected static function getMethod($name)
    {
        $class  = new ReflectionClass(SocketServiceProvider::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}