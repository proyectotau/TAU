<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
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

    public function test_UsersController_index(){
        $this->withoutExceptionHandling();

        //$this->actingAs(); // TODO

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
        $url = route('apiv1.admin.users.index');
        $response = $this->getJson($url);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([]);
    }

    /*public function test_UsersController_create(){
        $this->markTestSkipped( 'test_UsersController_update' );
        return;

        $response = $this->get(route('users.create'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assert([]);
    }*/

    public function test_UsersController_store(){
        $this->withoutExceptionHandling();

        $url = route('apiv1.admin.users.store');
        $response = $this->postJson($url, [
            'id'      => 1,
            'name'    => 'The Name',
            'surname' => 'The Surname'
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'      => 1,
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    public function test_UsersController_show(){
        $this->withoutExceptionHandling();

        $url = route('apiv1.admin.users.show', [
            'id' => 1
        ]);
        $response = $this->getJson($url,
            [
                'id' => 1
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'      => 1,
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    /*public function test_UsersController_edit(){
        $this->markTestSkipped( 'test_UsersController_edit' );
        return;
    }*/

    public function test_UsersController_update(){
        $this->withoutExceptionHandling();

        $url = route('apiv1.admin.users.update',[
            'id'    => 1
        ]);
        $response = $this->putJson($url,
            [
                'id'      => 1,
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'      => 1,
                'name'    => 'The Name',
                'surname' => 'The Surname'
            ]);
    }

    public function test_UsersController_destroy(){
        $this->withoutExceptionHandling();

       $url = route('apiv1.admin.users.destroy',[
            'id'    => 1
        ]);
       $response = $this->deleteJson($url,
           [
               'id'      => 1,
           ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'    => 1,
                'name'    => null,
                'surname' => null
            ]);
    }
}
