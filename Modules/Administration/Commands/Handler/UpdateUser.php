<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Entities\User;
use Modules\Administration\Repositories\Repository as UserRepository;

class UpdateUser implements Handler
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        $user = $this->user->find($command->id);

        $this->user->login = $command->login;
        $this->user->name = $command->name;
        $this->user->surname = $command->surname;
        $this->user->save();

        return $this->user;
    }
}