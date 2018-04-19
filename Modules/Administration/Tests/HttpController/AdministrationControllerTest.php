<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Administration\Http\Controllers\AdministrationController;

class AdministrationControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_Administration_Users_Controller_index(){
        //$this->withoutExceptionHandling();

        $response = $this->getJson('Administration/users');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name' => null, 'surname' => null
            ]);
    }

    public function test_Administration_Users_Controller_create(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_create' );
        return;
    }

    public function test_Administration_Users_Controller_store(){
        $response = $this->postJson('Administration/users',
            array(
                'name'    => 'The Name',
                'surname' => 'The Surname')
        );
        //dd($response);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    public function test_Administration_Users_Controller_show(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_show' );
        return;
    }

    public function test_Administration_Users_Controller_edit(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_edit' );
        return;
    }

    public function test_Administration_Users_Controller_update(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_update' );
        return;
    }

    public function test_Administration_Users_Controller_destroy(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_destroy' );
        return;
    }
}
