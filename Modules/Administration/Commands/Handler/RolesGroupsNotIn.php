<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class RolesGroupsNotIn implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command) {
        $groups_available = $this->group->whereDoesntHave('roles', function ($query) use ($command) {
            $query->where('perfil.ID_PERFIL', '=', $command->id);
        })->get();

        return $groups_available;
    }
}