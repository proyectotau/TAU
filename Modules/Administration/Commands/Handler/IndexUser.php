<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 20/04/2018
 * Time: 1:08
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Eloquent\User;
use Modules\Administration\Repositories\Repository;

class IndexUser implements Handler
{
    protected $user;

    public function __construct(Repository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        if ($command->criteria == null){
            $users = $this->user->get();
        } else {
            $users = $this->user
                ->  where(User::getFieldByAttribute('login'), 'like', '%'.$command->criteria.'%')
                ->orWhere(User::getFieldByAttribute('name'), 'like', '%'.$command->criteria.'%')
                ->orWhere(User::getFieldByAttribute('surname'), 'like', '%'.$command->criteria.'%')
                ->get();
        }
        return $users;
    }

    public function __toString() // TODO: move to BaseHandler
    {
        return __CLASS__;
    }
}