<?php

namespace Modules\Administration\Tests\Entities\Eloquent;

use Tests\TestCase;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Tests\Entities\ConfigTestValues;
use Modules\Administration\Repositories\Eloquent\Group;
use Modules\Administration\Repositories\Eloquent\User;

class GroupEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $app = Container::getInstance();
        $this->app->bind('Modules\Administration\Entities\User',
            'Modules\Administration\Repositories\Eloquent\User');
        $this->app->bind('Modules\Administration\Entities\Group',
            'Modules\Administration\Repositories\Eloquent\Group');
    }

    public function test_create_Group_Entity()
    {
        $testPrimaryKey = $this->testPrimaryKey;

        $group = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey));
        }

        $this->assertNotNull($group, 'Can not create Administration\Entities\Group');

        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
    }

    public function test_Group_Has_No_User(){
        $testPrimaryKey = $this->testPrimaryKey;

        $group = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey));
        }

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_GRUPO' => $group->ID_GRUPO
        ]);
    }

    public function test_Group_Has_An_User_Only(){
        $testPrimaryKey = $this->testPrimaryKey;

        $group = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey));
        }

        $user = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($testPrimaryKey));
        }

        // add user as a new member
        $group->users()->attach($user->ID_USUARIO);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $user->ID_USUARIO, 'ID_GRUPO' => $group->ID_GRUPO
        ]);
    }

    public function test_Group_HasMany_Users(){
        $testPrimaryKey = $this->testPrimaryKey;

        $group = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey));
        }

        $userA = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'A',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'A',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($testPrimaryKey));
        }

        $userB = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($testPrimaryKey));
        }

        // add users A and B as new members
        $group->users()->attach($userA->ID_USUARIO);
        $group->users()->attach($userB->ID_USUARIO);
        /*$group->users()->attach([
            $userA->ID_USUARIO,
            $userB->ID_USUARIO
        ]);*/

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $userA->ID_USUARIO, 'ID_GRUPO' => $group->ID_GRUPO,
            'ID_USUARIO' => $userB->ID_USUARIO, 'ID_GRUPO' => $group->ID_GRUPO
        ]);
    }
}
