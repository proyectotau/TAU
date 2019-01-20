<?php

namespace Modules\Administration\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Administration\Repositories\Repository;
use Modules\Administration\Exceptions\EntityException;

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

	protected static $attributes2fields = [
        'id' => 'ID_PERFIL',
        'name' => 'Nombre',
        'description' => 'DESCRIPCION'
    ];

    public function delete()
    {
        if( $this->id == 0) { // Administration role created during migrations
            throw new EntityException("Role with id == 0 can't be deleted");
        }

        return parent::delete();
    }

    /**
     * The groups that has a role.
     */
    public function roles()
    {
        return $this->belongsToMany(Group::class,'grupo_perfil','ID_PERFIL', 'ID_GRUPO');
	}

	public function getIdAttribute()
    {
        return $this->ID_PERFIL;
    }

	public function getNameAttribute()
    {
        return $this->Nombre;
    }

	public function getDescriptionAttribute()
    {
        return $this->DESCRIPCION;
    }
	public function setIdAttribute($id)
    {
        $this->ID_PERFIL = $id;
    }

    public function setNameAttribute($name)
    {
        $this->Nombre = $name;
    }

    public function setDescriptionAttribute($description)
    {
        $this->DESCRIPCION = $description;
    }

	public static function getFieldByAttribute($attribute)
    {
        return self::$attributes2fields[$attribute];
    }
}
