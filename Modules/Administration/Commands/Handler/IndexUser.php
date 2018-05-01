<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 20/04/2018
 * Time: 1:08
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class IndexUser implements Handler
{
    protected $user;

    public function __construct(Repository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        // TODO: Extract criteria from $command and use find() instead of all()
        $users = $this->user->all();
        return $users;
    }

    public function __toString() // TODO: move to BaseHandler
    {
        return __CLASS__;
    }
}