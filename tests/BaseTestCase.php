<?php

namespace Sanchescom\LaravelSocketIO\Test;

use Mockery;
use PHPUnit\Framework\TestCase;
/**
 * @package Neomerx\Tests\CorsIlluminate
 */
abstract class BaseTestCase extends TestCase
{
    /**
     * Tear down test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}