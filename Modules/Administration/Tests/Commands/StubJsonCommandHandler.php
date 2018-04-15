<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 08/04/2018
 * Time: 13:02
 */

namespace Modules\Administration\Tests\Commands;

/**
 * Class StubJsonCommandHandler
 * This handler echoes input command as json
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubJsonCommandHandler
{
    public function handle($command)
    {
        return json_encode($command);
    }
}