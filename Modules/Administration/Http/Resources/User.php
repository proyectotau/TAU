<?php

namespace Modules\Administration\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {//dd($request);
        /*return [
            'id'      => $this->id,
            'name'    => $this->name,
            'surname' => $this->surname
        ];*/
        return [
            'ID_USUARIO' => 1011,
            'USUARIO_RED' => 'login',
            'NOMBRE' => 'Name',
            'APELLIDOS' => 'Surname'
        ];
    }

    /*public function __toString() // TODO: move to BaseHandler
    {
        return "'ID_USUARIO' => 1011,
            'USUARIO_RED' => 'login',
            'NOMBRE' => 'Name',
            'APELLIDOS' => 'Surname'";
    }*/
}
