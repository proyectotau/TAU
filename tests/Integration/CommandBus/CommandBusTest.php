<?php

namespace Tests\Integration\CommandBus;

use Joselfonseca\LaravelTactician\CommandBusInterface;
use Tests\TestCase;

class CommandBusTest extends TestCase
{
    public function test_CommandBus_Is_Available()
    {
        //$this->assertSame(new CommandBusInterface(), $this->app->make('CommandBusInterface'));
        $this->markTestSkipped( 'test_CommandBus_Is_Available' );
    }
}