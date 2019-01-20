<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class ShowUser implements Handler
{
    protected $user;

    public function __construct(Repository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        $user = $this->user->find($command->id);

        return $user;
    }
}