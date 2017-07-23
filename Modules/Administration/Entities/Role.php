<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
