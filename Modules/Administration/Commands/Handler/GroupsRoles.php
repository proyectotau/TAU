<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 24/02/2019
 * Time: 23:52
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class GroupsRoles implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command)
    {
        $roles = $this->group
                      ->find($command->id)
                      ->roles()
                      ->get();

        return $roles;
    }
}