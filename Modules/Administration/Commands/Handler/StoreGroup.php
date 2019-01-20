<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class StoreGroup implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command)
    {
        $this->group->id = ($this->group->all()->max('id'))+1; // TODO
        $this->group->name = $command->name;
        $this->group->description = $command->description;
        $this->group->save();

        return $this->group;
    }
}