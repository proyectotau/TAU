<?php

namespace Modules\Administration\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Administration\Repositories\Repository;
use Modules\Administration\Exceptions\EntityException;

//TODO: MUST implements Repository instead of extends Illuminate\Database\Eloquent\Model
//TODO: interface Respository in Modules/Administration/Repositories/
//TODO: in Modules/Administration/Repositories/Eloquent
class User extends Model implements Repository
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

    protected static $attributes2fields = [
        'id' => 'ID_USUARIO',
        'login' => 'USUARIO_RED',
        'name' => 'NOMBRE',
        'surname' => 'APELLIDOS'
    ];

    public function delete()
    {
        if( $this->id == 0) { // Administrator user created during migrations
            throw new EntityException("User with id == 0 can't be deleted");
        }

        return parent::delete();
    }

    /**
     * The groups that user belongs to.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class,'usuario_grupo','ID_USUARIO','ID_GRUPO');
    }

    /*
     * Accessors provide Context Mapping to Boundle Context
     * Mutators comes from Request via CommandBus
     * TODO: Refactor to a ContextMapping Class with magic methods from input fields to output fields
     * [inputs fields] -> [output fields]
     */
    public function getIdAttribute()
    {
        return $this->ID_USUARIO;
    }

    public function getLoginAttribute()
    {
        return $this->USUARIO_RED;
    }

    public function getNameAttribute()
    {
        return $this->NOMBRE;
    }

    public function getSurnameAttribute()
    {
        return $this->APELLIDOS;
    }

    public function setIdAttribute($id)
    {
        $this->ID_USUARIO = $id;
    }

    public function setLoginAttribute($login)
    {
        $this->USUARIO_RED = $login;
    }

    public function setNameAttribute($name)
    {
        $this->NOMBRE = $name;
    }

    public function setSurnameAttribute($surname)
    {
        $this->APELLIDOS = $surname;
    }

    public static function getFieldByAttribute($attribute)
    {
        return self::$attributes2fields[$attribute];
    }

    private function tmp(){
        /*$u = new Modules\Admin
        $u->find(1);*/
    }
}