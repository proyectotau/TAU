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
 * Class StubJsonCommandHandler
 * This handler echos input command as json
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubJsonCommandHandler implements Handler // TODO: extends BaseHandler with __toString return get_class();
{
    public function handle($command)
    {
        // TODO: Extract criteria from $command and echos back
        return json_encode($command);
    }

    public function __toString()
    {
        return get_class();
    }
}