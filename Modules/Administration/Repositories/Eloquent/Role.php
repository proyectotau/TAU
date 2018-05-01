<?php

namespace Modules\Administration\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Administration\Repositories\Repository;

class Role extends Model implements Repository
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'perfil';

    protected $primaryKey = 'ID_PERFIL';

    protected $casts = [
        'ID_PERFIL' => 'integer',
        'Nombre' => 'string',
        'DESCRIPCION' => 'string'
    ];

    protected $fillable = [
        'ID_PERFIL',
        'Nombre',
        'DESCRIPCION'
    ];

    /**
     * The groups that has a role.
     */
    public function roles()
    {
        return $this->belongsToMany(Group::class,'grupo_perfil','ID_PERFIL', 'ID_GRUPO');
    }
}
