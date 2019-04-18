<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 21/04/2018
 * Time: 12:50
 */

namespace Modules\Administration\Commands\Handler;

use Illuminate\Support\Facades\DB;
use Modules\Administration\Repositories\Repository;

class GroupsUsersNotIn implements Handler
{
    protected $user;

    public function __construct(Repository $user)
    {
        $this->user = $user;
    }

    public function handle($command) {
        // TODO: FIX ME
        /*
        $users_available = $this->user->whereDoesntHave('groups', function ($query) use ($command) {
            $query->where('grupo.ID_GRUPO', '=', $command->id);
        })->get();
        */

        $users_available = DB::select('SELECT usuario.ID_USUARIO, usuario.NOMBRE, usuario.APELLIDOS, usuario.USUARIO_RED
 FROM usuario LEFT JOIN usuario_grupo ON usuario.ID_USUARIO = usuario_grupo.ID_USUARIO
 WHERE usuario_grupo.ID_GRUPO <> :id', ['id' => $command->id]);

        return $users_available;
    }
}