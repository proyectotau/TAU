<?php

namespace Modules\Administration\Commands;

use \JsonSerializable;

/**
 * Class Command User is a DTO
 * @package Modules\Administration\Commands
 */
class User implements JsonSerializable {

    // TODO: rename params as a ValueObject
    public $id;
    public $name;
    public $surname;

    public function __construct($id = null, $name = null, $surname = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
        ];
    }
}