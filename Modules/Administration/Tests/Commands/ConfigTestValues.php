<?php

/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 23/07/17
 * Time: 13:22
 *
 * Just gathers config values in a place
 */

namespace Modules\Administration\Tests\Commands;

use Joselfonseca\LaravelTactician\Bus as CommandBus;

trait ConfigTestValues
{
    private $debug = false;

    public function getInstanceOfCommandBus(){
        $commandBus = app(CommandBus::class);
        return $commandBus;
    }

    // TODO: move to helper
    public function bindCommandToHandler($commandBus, $command, $handler){
        $commandBus->addHandler($command, $handler);
    }

    public function dumperDump($x){
        (new Dumper)->dump($x);
        return $x;
    }
}