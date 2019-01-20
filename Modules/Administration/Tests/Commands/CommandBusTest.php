<?php

namespace Modules\Administration\Tests\Commands;

use Tests\TestCase;

use Modules\Administration\Commands\CommandBase;
use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubHandledCommandHandler;

class CommandBusTest extends TestCase
{
    use ConfigTestValues;

    public function test_User_Command_Exists()
    {
        $expected = CommandBase::class;

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, $expected, StubEchoCommandHandler::class);

        $actual = $commandBus->dispatch($expected, [
            "param1" => "TAU",
            "param2" => "Project"
        ], []);

        $this->assertInstanceOf($expected, $actual);
    }

    public function test_User_Command_IsHandled()
    {
        $expected = 'handled';

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, CommandBase::class, StubHandledCommandHandler::class);

        $actual = $commandBus->dispatch(CommandBase::class, [
            "param1" => "TAU",
            "param2" => "Project"
        ], []);

        $this->assertSame($expected, $actual);
    }
}