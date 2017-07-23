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

        $this->assertDatabaseMissing('grupo_perfil', [
            'ID_GRUPO' => $this->testPrimaryKey
        ]);
    }

    public function test_Group_Has_An_Role_Only(){
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

        $role = factory(Role::class)->create([
            'ID_PERFIL' => $this->testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $this->testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);
        if ($this->debug) {
            dd(Role::find($this->testPrimaryKey));
        }

        // grant to the group a new profile
        $group->roles()->attach($this->testPrimaryKey);

        $this->assertDatabaseHas('grupo_perfil', [
            'ID_GRUPO' => $this->testPrimaryKey, 'ID_PERFIL' => $this->testPrimaryKey
        ]);
    }

    public function test_Group_HasMany_Roles(){
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

        $roleA = factory(Role::class)->create([
            'ID_PERFIL' => $this->testPrimaryKey,
            'Nombre' => $this->testRoleName.'A',
            'DESCRIPCION' => $this->testRoleDescription.'A'
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $this->testPrimaryKey,
            'Nombre' => $this->testRoleName.'A',
            'DESCRIPCION' => $this->testRoleDescription.'A'
        ]);
        if ($this->debug) {
            dd(Role::find($this->testPrimaryKey));
        }

        $roleB = factory(Role::class)->create([
            'ID_PERFIL' => $this->testPrimaryKey+1,
            'Nombre' => $this->testRoleName.'B',
            'DESCRIPCION' => $this->testRoleDescription.'B'
        ]);
        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $this->testPrimaryKey+1,
            'Nombre' => $this->testRoleName.'B',
            'DESCRIPCION' => $this->testRoleDescription.'B'
        ]);
        if ($this->debug) {
            dd(Role::find($this->testPrimaryKey+1));
        }

        // grants to the group new profiles
        $group->roles()->attach($this->testPrimaryKey);
        $group->roles()->attach($this->testPrimaryKey+1);
        /*$group->roles()->attach([
            $this->testPrimaryKey,
            $this->testPrimaryKey+1
        ]);*/

        $this->assertDatabaseHas('grupo_perfil', [
            'ID_GRUPO' => $this->testPrimaryKey, 'ID_PERFIL' => $this->testPrimaryKey,
            'ID_GRUPO' => $this->testPrimaryKey, 'ID_PERFIL' => $this->testPrimaryKey+1
        ]);
    }
}
