<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 24/02/2019
 * Time: 23:52
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class RolesGroups implements Handler
{
    protected $role;

    public function __construct(Repository $role)
    {
        $this->role = $role;
    }

    public function handle($command)
    {
        $groups = $this->role
                      ->find($command->id)
                      ->groups()
                      ->get();

        return $groups;
    }
}