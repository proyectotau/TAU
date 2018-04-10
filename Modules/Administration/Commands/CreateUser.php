<?php

namespace Modules\Administration\Commands;

class CreateUser {

    // TODO: rename params as a ValueObject
    public $property;

    public $propertyTwo;

    public function __construct($property = null, $propertyTwo = "First Name")
    {
        $this->property = $property;
        $this->propertyTwo = $propertyTwo;
    }

}