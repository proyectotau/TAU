<?php

namespace Tests\GroupEntity;


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;

class GroupEntityTest extends TestCase
{
    use DatabaseTransactions;

    private $debug = false;

    private $testPrimaryKey = 1;
    private $testUserName = 'juan.espanol';
    private $testName = 'Juan';
    private $testLastName = 'Espanol';

    private $testGroupName = 'Test';
    private $testGroupDescription = 'Group for Testing';

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
            'ID_GRUPO' => $this->testPrimaryKey
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
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $group->users()->attach($this->testPrimaryKey);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey
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
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'A',
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $userB = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey+1,
            'USUARIO_RED' => $this->testUserName.'B',
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $group->users()->attach($this->testPrimaryKey);
        $group->users()->attach($this->testPrimaryKey+1);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey,
            'ID_USUARIO' => $this->testPrimaryKey+1, 'ID_GRUPO' => $this->testPrimaryKey
        ]);
    }
}
