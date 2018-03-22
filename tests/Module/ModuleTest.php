<?php

namespace Tests\Module;

use Tests\TestCase;
use Nwidart\Modules\Facades\Module;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan;

class ModuleTest extends TestCase
{
//    use DatabaseTransactions;

    private $debug = false;

    public function test_Administration_module_exists()
    {
        $admin = Module::find('Administration');

        $this->assertNotNull($admin, 'Administration module does not exist');
    }


    /**
     * @link https://laracasts.com/discuss/channels/laravel/getting-artisancall-output
     */
    public function NO_test_artisan(){

        Artisan::call('route:list');
        $o = Artisan::output();
        dd($o);

        $a = explode(PHP_EOL,  $o);
        dd( $a );

        $b = explode('| ',  $a[3]);
        dd($b);
    }
}
