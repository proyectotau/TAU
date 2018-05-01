<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 08/04/2018
 * Time: 13:02
 */

namespace Modules\Administration\Tests\Commands;

use Modules\Administration\Commands\Handler\Handler;

/**
 * Class StubEchoCommandHandler
 * This handler return an known response
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubHandledCommandHandler implements Handler
{
    public function handle($command)
    {
        return 'handled';
    }
}