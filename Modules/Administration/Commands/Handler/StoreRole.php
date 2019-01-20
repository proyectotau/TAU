<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class StoreRole implements Handler
{
    protected $role;

    public function __construct(Repository $role)
    {
        $this->role = $role;
    }

    public function handle($command)
    {
        $this->role->id = ($this->role->all()->max('id'))+1; // TODO
        $this->role->name = $command->name;
        $this->role->description = $command->description;
        $this->role->save();

        return $this->role;
    }
}