<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Illuminate\Http\Response;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
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

    public function test_RolesController_test(){
        $this->markTestSkipped('For purpose to test the tests only');

        $url = 'test/';
        $response = $this->json('GET', $url,
            [
                'id'      => 1,
                'name'    => 'The Name',
                'description' => 'The Description'
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'      => 1,
                'name'    => 'The Name',
                'description' => 'The Description'
            ]);
    }

    public function test_RolesController_index(){
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
            'Modules\Administration\Commands\IndexRole' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.roles.index');
        //$url = route('admin.roles.index');
        $response = $this->json('GET', $url);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([]);
    }

    public function test_RolesController_index_with_criteria(){
        $this->withoutExceptionHandling();

        //$this->actingAs(); // TODO

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\IndexRole' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.roles.index');
        $response = $this->json('GET', $url, [
            'criteria' => 'ALL'
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'criteria' => 'ALL'
            ]);
    }

     public function test_RolesController_store(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\StoreRole' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'name'    => 'The Name',
            'description' => 'The Description'
        ];

        $url = route('apiv1.admin.roles.store');
        $response = $this->json('POST', $url, $data);

        $response
            //->assertStatus(Response::HTTP_CREATED) // TODO
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_RolesController_show(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\ShowRole' =>
            'Modules\Administration\Tests\Commands\StubRoleShowCommandHandler'
        ]);

        $url = route('apiv1.admin.roles.show', [
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
                'description' => 'The Description'
            ]);
    }

    public function test_RolesController_update(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\UpdateRole' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'id'      => 1,
            'name'    => 'The Name',
            'description' => 'The Description'
        ];

        $url = route('apiv1.admin.roles.update', $data);

        $response = $this->json('PUT', $url, $data);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_RolesController_destroy(){
       $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\DestroyRole' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

       $url = route('apiv1.admin.roles.destroy', [
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
