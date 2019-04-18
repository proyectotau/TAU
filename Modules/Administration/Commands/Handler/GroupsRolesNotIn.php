<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class GroupsRolesNotIn implements Handler
{
    protected $role;

    public function __construct(Repository $role)
    {
        $this->role = $role;
    }

    public function handle($command) {
        $roles_available = $this->role->whereDoesntHave('groups', function ($query) use ($command) {
            $query->where('grupo.ID_GRUPO', '=', $command->id);
        })->get();

        return $roles_available;
    }
}