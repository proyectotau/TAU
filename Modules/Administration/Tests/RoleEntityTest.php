<?php

namespace Modules\Administration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Entities\Role;
use Modules\Administration\Entities\Group;

class RoleEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;

    public function test_Group_Has_No_Role(){
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

        $this->assertDatabaseMissing('grupo_perfil', [
            'ID_GRUPO' => $testPrimaryKey
        ]);
    }

    public function test_Group_Has_An_Role_Only(){
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

        $role = factory(Role::class)->create([
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);
        if ($this->debug) {
            dd(Role::find($testPrimaryKey));
        }

        // grant to the group a new profile
        $group->roles()->attach($testPrimaryKey);

        $this->assertDatabaseHas('grupo_perfil', [
            'ID_GRUPO' => $testPrimaryKey, 'ID_PERFIL' => $testPrimaryKey
        ]);
    }

    public function test_Group_HasMany_Roles(){
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

        $roleA = factory(Role::class)->create([
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName.'A',
            'DESCRIPCION' => $this->testRoleDescription.'A'
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName.'A',
            'DESCRIPCION' => $this->testRoleDescription.'A'
        ]);
        if ($this->debug) {
            dd(Role::find($testPrimaryKey));
        }

        $roleB = factory(Role::class)->create([
            'ID_PERFIL' => $testPrimaryKey+1,
            'Nombre' => $this->testRoleName.'B',
            'DESCRIPCION' => $this->testRoleDescription.'B'
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $testPrimaryKey+1,
            'Nombre' => $this->testRoleName.'B',
            'DESCRIPCION' => $this->testRoleDescription.'B'
        ]);
        if ($this->debug) {
            dd(Role::find($testPrimaryKey+1));
        }

        // grants to the group new profiles
        $group->roles()->attach($testPrimaryKey);
        $group->roles()->attach($testPrimaryKey+1);
        /*$group->roles()->attach([
            $testPrimaryKey,
            $testPrimaryKey+1
        ]);*/

        $this->assertDatabaseHas('grupo_perfil', [
            'ID_GRUPO' => $testPrimaryKey, 'ID_PERFIL' => $testPrimaryKey,
            'ID_GRUPO' => $testPrimaryKey, 'ID_PERFIL' => $testPrimaryKey+1
        ]);
    }
}
