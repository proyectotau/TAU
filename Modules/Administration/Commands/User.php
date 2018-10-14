<?php

namespace Modules\Administration\Commands;

use \JsonSerializable;

/**
 * Class Command User is a DTO
 * @package Modules\Administration\Commands
 */
class User implements JsonSerializable {

    // TODO: rename params as a ValueObject with _magic members
    private $data = [];
    /*public $id;
    public $login;
    public $name;
    public $surname;*/

    /*public function __construct($id = null, $login = null, $name = null, $surname = null)
    {
        dxd($id , $login , $name , $surname );
        $this->id = $id;
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
    }*/

    public function __construct(array $data = []){
        $this->data = $data;
    }

    /*public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }*/

    public function __get($name)
    {
        return $this->data[$name];
    }

    // https://stackoverflow.com/questions/401908/php-tostring-and-json-encode-not-playing-well-together
    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->data;
        /*return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'surname' => $this->surname,
        ];*/
    }
}