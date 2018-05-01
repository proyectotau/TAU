<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 20/04/2018
 * Time: 1:12
 */

namespace Modules\Administration\Commands\Handler;

interface Handler
{
    //TODO: Command interface type-hint
    public function handle($command); /*Command*/
}