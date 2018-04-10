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
 * This handler return an known response
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubHandledCommandHandler
{
    public function handle($command)
    {
        return 'handled';
    }
}