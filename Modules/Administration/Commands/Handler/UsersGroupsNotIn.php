<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class UsersGroupsNotIn implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command) {
        $groups_available = $this->group->whereDoesntHave('users', function ($query) use ($command) {
            $query->where('usuario.ID_USUARIO', '=', $command->id);
        })->get();

        return $groups_available;
    }
}