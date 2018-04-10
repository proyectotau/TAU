<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Model;

//TODO: MUST implements Repository instead of extends Illuminate\Database\Eloquent\Model
//TODO: interface Respository in Modules/Administration/Repositories/
//TODO: in Modules/Administration/Repositories/Eloquent
class User extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'usuario';

    protected $primaryKey = 'ID_USUARIO';

    protected $casts = [
        'ID_USUARIO' => 'integer',
        'USUARIO_RED' => 'string',
        'NOMBRE' => 'string',
        'APELLIDOS' => 'string'
    ];

    protected $fillable = [
        'ID_USUARIO',
        'USUARIO_RED',
        'NOMBRE',
        'APELLIDOS'
    ];

    /**
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class,'usuario_grupo','ID_USUARIO','ID_GRUPO');
    }
}
