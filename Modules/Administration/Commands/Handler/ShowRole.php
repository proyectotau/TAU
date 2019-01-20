<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class ShowRole implements Handler
{
    protected $role;

    public function __construct(Repository $role)
    {
        $this->role = $role;
    }

    public function handle($command)
    {
        $role = $this->role->find($command->id);

        return $role;
    }
}