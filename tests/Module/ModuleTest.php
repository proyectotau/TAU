<?php

namespace Tests\Module;

use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Nwidart\Modules\Facades\Module;
use Illuminate\Routing\Route;
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
    /* // TODO: get route list programmatically
    public function test_artisan_route_list(){

        Artisan::call('route:list');
        $o = Artisan::output();
        dd($o);

        $a = explode(PHP_EOL,  $o);
        dd( $a );

        $b = explode('| ',  $a[3]);
        dd($b);
    }
    */

    public function test_get_Routes(){
        $router = App::make('router');
        $routes = $router->getRoutes() // from Router
                         ->getRoutes();// from RouteCollection

//dd($routes);

        foreach ($routes as $route){
            echo $route->methods[0] . ' ' . $route->uri . ' ' . /*$route->action['as'] .*/ PHP_EOL;
        }

        $this->assertTrue(true);


    }
}
