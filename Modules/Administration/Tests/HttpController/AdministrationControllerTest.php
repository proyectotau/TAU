<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Http\Response;
use Tests\TestCase;

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
        $this->withoutExceptionHandling();

        /*
         * Things to do in order to test pass:
         */
        /**
         * 1. When visit page
         * 2. Route will make Controller
         * 3. Index method will be invoke
         *    Controller and method are the real ones, not stub ones
         * 4. Controller's __contruct no need to receive Repository neither CommandHandler yet
         *    Respository is delayed until CommandHandler is created and CommandHandler is binding in Service Provider
         * 5. We receive response from CommandHandler
         */
        $response = $this->getJson('Administration/users');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([]);
    }

    /*public function test_Administration_Users_Controller_create(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_update' );
        return;

        $response = $this->get(route('users.create'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assert([]);
    }*/

    public function test_Administration_Users_Controller_store(){
        $this->withoutExceptionHandling();

        $response = $this->postJson('Administration/users',
            [
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]
        );

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    public function test_Administration_Users_Controller_show(){
        $this->withoutExceptionHandling();

        $response = $this->getJson('Administration/users/1');
        //$response = $this->getJson(route('users.show', 1));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'    => 1,
            ]);
    }

    /*public function test_Administration_Users_Controller_edit(){
        $this->markTestSkipped( 'test_Administration_Users_Controller_edit' );
        return;
    }*/

    public function test_Administration_Users_Controller_update(){
        $this->withoutExceptionHandling();

        $response = $this->putJson(route('users.update',1),
            [
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'    => 1,
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    public function test_Administration_Users_Controller_destroy(){
        $this->withoutExceptionHandling();

       $response = $this->deleteJson(route('users.destroy',1));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'    => 1,
            ]);
    }
}
