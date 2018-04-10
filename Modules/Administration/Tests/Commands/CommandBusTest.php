<?php

namespace Modules\Administration\Tests\Commands;

use Tests\TestCase;

use Modules\Administration\Commands\CreateUser;
use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubHandledCommandHandler;

class CommandBusTest extends TestCase
{
    use ConfigTestValues;

    public function test_CreateUser_Command_Exists()
    {
        $expected = CreateUser::class;

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, $expected, StubEchoCommandHandler::class);

        $actual = $commandBus->dispatch($expected, [
            "uno" => "PEPE",
            "dos" => "PACO"
        ], []);

        $this->assertInstanceOf($expected, $actual);
    }

    public function test_CreateUser_Command_IsHandled()
    {
        $expected = 'handled';

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, CreateUser::class, StubHandledCommandHandler::class);

        $actual = $commandBus->dispatch(CreateUser::class, [
            "uno" => "PEPE",
            "dos" => "PACO"
        ], []);

        $this->assertSame($expected, $actual);
    }
}