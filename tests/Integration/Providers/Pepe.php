<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/04/2018
 * Time: 1:28
 */

namespace Tests\Integration\Providers;

class Pepe implements Alguien
{
    public function soy()
    {
        return get_class($this);
    }
}