<?php

namespace Modules\Administration\Commands;

/**
 * Class CreateUser is a DTO
 * @package Modules\Administration\Commands
 */
class User  {

    // TODO: rename params as a ValueObject
    public $name;

    public $surname;

    public function __construct($name = null, $surname = null)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        /*return
                '"name": ' . ($this->name ?? 'null') .', '.
                '"surname": ' . ($this->surname ?? 'null')
                ;*/
        return
            '"name": ' . (isset($this->name) ? $this->name : 'null') .', '.
            '"surname": ' . (isset($this->surname) ? $this->surname : 'null')
            ;
    }
}