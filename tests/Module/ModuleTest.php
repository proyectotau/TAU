<?php

namespace Tests\Module;

use Tests\TestCase;
use Nwidart\Modules\Facades\Module;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModuleTest extends TestCase
{
    use DatabaseTransactions;

    private $debug = false;

    public function test_Administration_module_exists()
    {
        $admin = Module::find('Administration');

        $this->assertNotNull($admin, 'Administration module does not exist');
    }
}
