<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseTransactions;

    private function bindsCommandToHandler(array $commandsHandlers)
    {
        $bus = $this->app->make(CommandBus::class);
        foreach ($commandsHandlers as $command => $handler) {
            $bus->addHandler($command, $handler);
        }
        $this->app->instance('admin.commandbus', $bus);

        //dd($bus->dump());
    }

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

    public function skip_test_UsersController_test(){
        $url = 'test/';
        $response = $this->json('GET', $url,
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
         *    Respository is delayed until CommandHandler is created and CommandHandler is bound in Service Provider
         * 5. We receive response from CommandHandler
         */

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\IndexUser' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.users.index');
        //$url = route('admin.users.index');
        $response = $this->json('GET', $url);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([]);
    }

    public function skip_test_UsersController_index_with_criteria(){
        $this->withoutExceptionHandling();

        //$this->actingAs(); // TODO

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\IndexUser' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.users.index');
        $response = $this->json('GET', $url, [
            'criteria' => 'ALL'
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'criteria' => 'ALL'
            ]);
    }

     public function test_UsersController_store(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\StoreUser' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'login'   => 'login',
            'name'    => 'The Name',
            'surname' => 'The Surname'
        ];

        $url = route('apiv1.admin.users.store');
        $response = $this->json('POST', $url, $data);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_UsersController_show(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\ShowUser' =>
            'Modules\Administration\Tests\Commands\StubShowCommandHandler'
        ]);

        $url = route('apiv1.admin.users.show', [
            'id' => 1
        ]);

        $response = $this->json('GET', $url, [
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

    public function test_UsersController_update(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\UpdateUser' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'id'      => 1,
            'name'    => 'The Name',
            'surname' => 'The Surname'
        ];

        $url = route('apiv1.admin.users.update', $data);

        $response = $this->json('PUT', $url, $data);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_UsersController_destroy(){
       $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\DestroyUser' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

       $url = route('apiv1.admin.users.destroy', [
           'id'      => 1
       ]);
       $response = $this->json('DELETE', $url, [
               'id'      => 1
           ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'    => 1
            ]);
    }
}
