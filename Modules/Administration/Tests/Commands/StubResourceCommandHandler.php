<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 08/04/2018
 * Time: 13:02
 */

namespace Modules\Administration\Tests\Commands;

use Modules\Administration\Commands\Handler\Handler;
use Modules\Administration\Http\Resources\User as UserResource;
use Modules\Administration\Repositories\Eloquent\User;
use Modules\Administration\Repositories\Repository as UserRepository;

/**
 * Class StubEchoCommandHandler
 * This handler echoes input command
 *
 * @package Modules\Administration\Tests\Commands
 */
class StubResourceCommandHandler implements Handler
{
    /**
     * @var UserRepository
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle($command)
    {
        //return new UserResource($command->getData());
        /*return new UserResource([
            'id'      => 1,
            'name'    => 'The Name',
            'surname' => 'The Surname'
        ]);*/
        //dd( new UserResource(User::find(1)) );
        return new UserResource($this->user->find(10000));
    }
}