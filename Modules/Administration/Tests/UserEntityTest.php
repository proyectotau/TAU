<?php

namespace Modules\Administration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;

class UserEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;

    public function test_create_User_Entity()
    {
        $user = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $this->assertNotNull($user, 'Can not create Administration\Entities\User');

        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
    }

    public function test_create_Group_Entity()
    {
        $group = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }

        $this->assertNotNull($group, 'Can not create Administration\Entities\Group');

        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
    }

    public function test_User_BelongsTo_No_Groups()
    {
        $user = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey
        ]);
    }

    public function test_User_BelongsTo_A_One_Group_Only()
    {
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

        // add relation
        $user->groups()->attach($this->testPrimaryKey);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey,
        ]);
    }

    public function test_User_HasMany_Groups()
    {
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

        $groupA = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName . 'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName . 'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }
        $groupB = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey + 1,
            'NOMBRE' => $this->testGroupName . 'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey + 1,
            'NOMBRE' => $this->testGroupName . 'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey + 1));
        }

        // add relations
        $user->groups()->attach($groupA->ID_GRUPO);
        $user->groups()->attach($groupB->ID_GRUPO);
        //$user->groups()->attach($this->testPrimaryKey);
        //$user->groups()->attach($this->testPrimaryKey+1);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey,
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey + 1
        ]);
    }
}
