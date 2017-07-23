<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'grupo';

    protected $primaryKey = 'ID_GRUPO';

    public $timestamps = false;

    protected $casts = [
        'ID_GRUPO' => 'integer',
        'NOMBRE' => 'string',
        'DESCRIPCION' => 'string'
    ];

    protected $fillable = [
        'ID_GRUPO',
        'NOMBRE',
        'DESCRIPCION'
    ];

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'usuario_grupo','ID_GRUPO','ID_USUARIO');
    }
}
