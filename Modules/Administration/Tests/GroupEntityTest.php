<?php

namespace Modules\Administration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Entities\Group;
use Modules\Administration\Entities\User;

class GroupEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;

    public function test_Group_Has_No_User(){
        $group = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_GRUPO' => $group->ID_GRUPO
        ]);
    }

    public function test_Group_Has_An_User_Only(){
        $group = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }

        $user = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        // add user as a new member
        $group->users()->attach($user->ID_USUARIO);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $user->ID_USUARIO, 'ID_GRUPO' => $group->ID_GRUPO
        ]);
    }

    public function test_Group_HasMany_Users(){
        $group = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }

        $userA = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'A',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'A',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $userB = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
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
