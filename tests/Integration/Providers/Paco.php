<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/04/2018
 * Time: 1:29
 */

namespace Tests\Integration\Providers;

class Paco implements Alguien
{
    public function soy()
    {
        return get_class($this);
    }
}