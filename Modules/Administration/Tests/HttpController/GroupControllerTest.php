<?php

namespace Modules\Administration\Tests\HttpController;

use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Illuminate\Http\Response;
use Tests\TestCase;

class GroupControllerTest extends TestCase
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->markTestSkipped('For purpose to test the tests only');

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_GroupsController_test(){
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

    public function test_GroupsController_index(){
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
            'Modules\Administration\Commands\IndexGroup' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.groups.index');
        //$url = route('admin.groups.index');
        $response = $this->json('GET', $url);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'criteria' => null
            ]);
    }

    public function test_GroupsController_index_with_criteria(){
        $this->withoutExceptionHandling();

        //$this->actingAs(); // TODO

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\IndexGroup' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $url = route('apiv1.admin.groups.index');
        $response = $this->json('GET', $url, [
            'criteria' => 'ALL'
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'criteria' => 'ALL'
            ]);
    }

     public function test_GroupsController_store(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\StoreGroup' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'name'    => 'The Name',
            'description' => 'The Description'
        ];

        $url = route('apiv1.admin.groups.store');
        $response = $this->json('POST', $url, $data);

        $response
            //->assertStatus(Response::HTTP_CREATED) // TODO
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_GroupsController_show(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\ShowGroup' =>
            'Modules\Administration\Tests\Commands\StubGroupShowCommandHandler'
        ]);

        $url = route('apiv1.admin.groups.show', [
            'id' => 0
        ]);

        $response = $this->json('GET', $url, [
                'id' => 0
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id'      => 0,
                'name'    => 'The Name',
                'description' => 'The Description'
            ]);
    }

    public function test_GroupsController_update(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\UpdateGroup' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

        $data = [
            'id'      => 1,
            'name'    => 'The Name',
            'description' => 'The Description'
        ];

        $url = route('apiv1.admin.groups.update', $data);

        $response = $this->json('PUT', $url, $data);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function test_GroupsController_destroy(){
       $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\DestroyGroup' =>
            'Modules\Administration\Tests\Commands\StubEchoCommandHandler'
        ]);

       $url = route('apiv1.admin.groups.destroy', [
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

    public function test_GroupsController_Users_Members(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsUsers' =>
            'Modules\Administration\Commands\Handler\GroupsUsers', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.users', [
            'id'      => 0
        ]);

        $response = $this->json('GET', $url, [
            'id'      => 0
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'ID_USUARIO' => 0,
                'USUARIO_RED' => 'Administrador',
                'NOMBRE' => 'Administrador',
                'APELLIDOS' => 'TAU',
            ]);
    }

    public function test_GroupsController_Users_Not_Members(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsUsersNotIn' =>
            'Modules\Administration\Commands\Handler\GroupsUsersNotIn', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.usersnotin', [
            'id'      => 0
        ]);

        $response = $this->json('GET', $url, [
            'id'      => 0
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonMissing([
                'ID_USUARIO' => 0,
                'USUARIO_RED' => 'Administrador',
                'NOMBRE' => 'Administrador',
                'APELLIDOS' => 'TAU',
            ]);
    }

    public function test_GroupController_Sync_New_List_Of_Users(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsUsersUpdate' =>
            'Modules\Administration\Commands\Handler\GroupsUsersUpdate', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.users.update', [
            'id'      => 0
        ]);
        $response = $this->json('PUT', $url, [
            'id'      => 0,
            'memberOf' => [
                0 => 0,
            ]
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'ID_USUARIO' => 0,
                'USUARIO_RED' => 'Administrador',
                'NOMBRE' => 'Administrador',
                'APELLIDOS' => 'TAU',
            ]);
        /*->assertJson([
            'id'      => 0,
            'name'    => 'The Name',
            'surname' => 'The Surname'
        ]);*/
    }

    ////

    public function test_GroupsController_Has_Roles(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsRoles' =>
                'Modules\Administration\Commands\Handler\GroupsRoles', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.roles', [
            'id'      => 0
        ]);

        $response = $this->json('GET', $url, [
            'id'      => 0
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'ID_PERFIL' => 0,
                'Nombre' => 'Administracion',
                'DESCRIPCION' => 'El grupo con este perfil puede acceder a todos los metodos de todas las clases'
            ]);
    }

    public function test_GroupsController_Has_not_Roles(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsRolesNotIn' =>
                'Modules\Administration\Commands\Handler\GroupsRolesNotIn', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.rolesnotin', [
            'id'      => 0
        ]);

        $response = $this->json('GET', $url, [
            'id'      => 0
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'ID_PERFIL' => 1,
                'Nombre' => 'Perfil Base',
                'DESCRIPCION' => 'Acceso basico a los modulos iniciales usados en el Tema Guay'
            ]);
    }

    public function test_GroupController_Sync_New_List_Of_Roles(){
        $this->withoutExceptionHandling();

        $this->bindsCommandToHandler([
            'Modules\Administration\Commands\GroupsRolesUpdate' =>
            'Modules\Administration\Commands\Handler\GroupsRolesUpdate', // Real, not stub
        ]);

        $url = route('apiv1.admin.groups.roles.update', [
            'id'      => 0
        ]);
        $response = $this->json('PUT', $url, [
            'id'      => 0,
            'memberOf' => [
                0 => 0,
                1 => 1,
            ]
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'ID_PERFIL'    => 0,
                'Nombre'      => 'Administracion',
                'DESCRIPCION' => 'El grupo con este perfil puede acceder a todos los metodos de todas las clases'
            ])->assertJsonFragment([
                'ID_PERFIL'    => 1,
                'Nombre'      => 'Perfil Base',
                'DESCRIPCION' => 'Acceso basico a los modulos iniciales usados en el Tema Guay'
            ]);

        $this->assertNotRepeatedQueries();
    }
}
