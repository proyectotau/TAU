<?php

namespace Modules\Administration\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Administration\Repositories\Repository;
use Modules\Administration\Exceptions\EntityException;

class Group extends Model implements Repository
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'grupo';

    protected $primaryKey = 'ID_GRUPO';

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

    public function delete()
    {
        if( $this->id == 0) { // Administrator group created during migrations
            throw new EntityException("Group with id == 0 can't be deleted");
        }

        return parent::delete();
    }

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'usuario_grupo','ID_GRUPO','ID_USUARIO');
    }

    /**
     * The roles that grant access to the group.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'grupo_perfil','ID_GRUPO','ID_PERFIL');
    }

	public function getIdAttribute()
    {
        return $this->ID_GRUPO;
    }

	public function getNameAttribute()
    {
        return $this->NOMBRE;
    }

	public function getDescriptionAttribute()
    {
        return $this->DESCRIPCION;
    }
}
