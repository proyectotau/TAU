<?php

namespace Modules\Administration\Tests\Commands;

use Tests\TestCase;

use Modules\Administration\Commands\User;
use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubHandledCommandHandler;

class CommandBusTest extends TestCase
{
    use ConfigTestValues;

    public function test_User_Command_Exists()
    {
        $expected = User::class;

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, $expected, StubEchoCommandHandler::class);

        $actual = $commandBus->dispatch($expected, [
            "uno" => "PEPE",
            "dos" => "PACO"
        ], []);

        $this->assertInstanceOf($expected, $actual);
    }

    public function test_User_Command_IsHandled()
    {
        $expected = 'handled';

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, User::class, StubHandledCommandHandler::class);

        $actual = $commandBus->dispatch(User::class, [
            "uno" => "PEPE",
            "dos" => "PACO"
        ], []);

        $this->assertSame($expected, $actual);
    }
}