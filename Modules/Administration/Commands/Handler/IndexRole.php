<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 20/04/2018
 * Time: 1:08
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Eloquent\Role;
use Modules\Administration\Repositories\Repository;

class IndexRole implements Handler
{
    protected $role;

    public function __construct(Repository $role)
    {
        $this->role = $role;
    }

    public function handle($command)
    {
        if ($command->criteria == null){
            $roles = $this->role->get();
        } else {
            $roles = $this->role
                ->  where(Role::getFieldByAttribute('name'), 'like', '%'.$command->criteria.'%')
                ->orWhere(Role::getFieldByAttribute('description'), 'like', '%'.$command->criteria.'%')
                ->get();
        }
        return $roles;
    }

    public function __toString() // TODO: move to BaseHandler
    {
        return __CLASS__;
    }
}