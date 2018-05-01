<?php

namespace Tests\Integration\CommandBus;

use Tests\TestCase;
use Illuminate\Container\Container;

class CommandBusTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $app = Container::getInstance();
        $this->app->bind('Joselfonseca\LaravelTactician\CommandBusInterface',
            'Joselfonseca\LaravelTactician\Bus');
    }

    public function test_CommandBus_Is_Available()
    {
        $commandBus = resolve('Joselfonseca\LaravelTactician\CommandBusInterface');
        $this->assertNotNull($commandBus, 'Can not create Joselfonseca\LaravelTactician\CommandBusInterface');
    }
}