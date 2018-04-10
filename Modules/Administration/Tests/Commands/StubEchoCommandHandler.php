<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 08/04/2018
 * Time: 13:02
 */

namespace Modules\Administration\Tests\Commands;

/**
 * Class StubEchoCommandHandler
 * This handler echoes input command
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubEchoCommandHandler
{
    public function handle($command)
    {
        return $command;
    }
}