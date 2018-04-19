<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 17/04/2018
 * Time: 21:52
 */

namespace Tests\Integration\Providers;

use Tests\TestCase;

class ProvidersTest extends TestCase
{
    public function test_make_Alguien()
    {
       $this->assertTrue(
            in_array('Tests\Integration\Providers\Alguien',
                class_implements($this->app->make('Tests\Integration\Providers\Alguien'), false),
                    true));
    }
}