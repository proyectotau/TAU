<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 08/04/2018
 * Time: 17:35
 */

namespace Modules\Administration\Tests\HttpController;


//use Illuminate\Foundation\Testing\TestCase;
//use PHPUnit_Framework_TestCase;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;
use Modules\Administration\Http\Controllers\AdministrationController;


//class AdministrationControllerTest extends PHPUnit_Framework_TestCase
class AdministrationControllerTestNO extends TestCase
{
    public function NOtest_CreateUser_controller_makes_Command(){
        $this->markTestSkipped('test_CreateUser_controller_makes_Command pending');
        return;
        /*$expected = ['p'=>'PEPE'];

        $this->visit('/Administration.user');

        $userController = new AdministrationController();
        $actual = $userController->create(new \Illuminate\Http\Request($expected));

        $this->assertSame($expected, $actual);*/
    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        // TODO: Implement createApplication() method.
    }
}
