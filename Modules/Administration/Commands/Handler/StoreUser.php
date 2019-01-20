<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Modules\Administration\Repositories\Repository;

class StoreUser implements Handler
{
    protected $user;

    public function __construct(Repository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        $this->user->id = ($this->user->all()->max('id'))+1; // TODO
        $this->user->login = $command->login;
        $this->user->name = $command->name;
        $this->user->surname = $command->surname;
        $this->user->save();

        return $this->user;
    }
}