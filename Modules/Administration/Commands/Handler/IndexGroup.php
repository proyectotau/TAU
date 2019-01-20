<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 20/04/2018
 * Time: 1:08
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Eloquent\Group;
use Modules\Administration\Repositories\Repository;

class IndexGroup implements Handler
{
    protected $group;

    public function __construct(Repository $group)
    {
        $this->group = $group;
    }

    public function handle($command)
    {
        if ($command->criteria == null){
            $groups = $this->group->get();
        } else {
            $groups = $this->group
                ->  where(Group::getFieldByAttribute('name'), 'like', '%'.$command->criteria.'%')
                ->orWhere(Group::getFieldByAttribute('description'), 'like', '%'.$command->criteria.'%')
                ->get();
        }
        return $groups;
    }

    public function __toString() // TODO: move to BaseHandler
    {
        return __CLASS__;
    }
}