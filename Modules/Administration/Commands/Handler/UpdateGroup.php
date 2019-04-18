<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class UpdateGroup implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command)
    {
        $group = $this->group->find($command->id);

        $group->name = $command->name;
        $group->description = $command->description;

        $group->update();

        return $group;
    }
}