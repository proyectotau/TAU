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
        $testPrimaryKey = $this->testPrimaryKey;

        $user = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($testPrimaryKey));
        }

        $this->assertNotNull($user, 'Can not create Administration\Entities\User');

        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
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

    public function test_User_BelongsTo_No_Groups()
    {
        $testPrimaryKey = $this->testPrimaryKey;

        $user = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($testPrimaryKey));
        }

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey
        ]);
    }

    public function test_User_BelongsTo_A_One_Group_Only()
    {
        $testPrimaryKey = $this->testPrimaryKey;

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

        // add relation
        $user->groups()->attach($testPrimaryKey);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
        ]);
    }

    public function test_User_HasMany_Groups()
    {
        $testPrimaryKey = $this->testPrimaryKey;

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

        $groupA = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName . 'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName . 'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey));
        }
        $groupB = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey + 1,
            'NOMBRE' => $this->testGroupName . 'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey + 1,
            'NOMBRE' => $this->testGroupName . 'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);
        if ($this->debug) {
            dd(Group::find($testPrimaryKey + 1));
        }

        // add relations
        $user->groups()->attach($groupA->ID_GRUPO);
        $user->groups()->attach($groupB->ID_GRUPO);
        //$user->groups()->attach($testPrimaryKey);
        //$user->groups()->attach($testPrimaryKey+1);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey + 1
        ]);
    }
}
