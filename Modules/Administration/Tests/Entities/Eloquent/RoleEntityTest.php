<?php

namespace Modules\Administration\Tests\Entities\Eloquent;

use Tests\TestCase;
use Tests\DetectRepeatedQueries;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Modules\Administration\Tests\Entities\ConfigTestValues;
use Modules\Administration\Repositories\Eloquent\Role;
use Modules\Administration\Repositories\Eloquent\Group;
use Modules\Administration\Exceptions\EntityException;

class RoleEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->enableQueryLog();

        $app = Container::getInstance();

        $this->app->bind('Modules\Administration\Entities\Group',
            'Modules\Administration\Repositories\Eloquent\Group');
        $this->app->bind('Modules\Administration\Entities\Role',
            'Modules\Administration\Repositories\Eloquent\Role');
    }

	public function tearDown()
    {
        $this->flushQueryLog();
        parent::tearDown();
    }

    public function test_create_Role_Entity()
    {
        $testPrimaryKey = $this->testPrimaryKey;

        $role = factory(Role::class)->create([
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);

        $this->assertNotNull($role, 'Can not create Administration\Entities\Role');

        $this->assertDatabaseHas('perfil', [
            'ID_PERFIL' => $testPrimaryKey,
            'Nombre' => $this->testRoleName,
            'DESCRIPCION' => $this->testRoleDescription
        ]);

        $this->assertNotRepeatedQueries();
    }

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

        $this->assertDatabaseMissing('grupo_perfil', [
            'ID_GRUPO' => $testPrimaryKey
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_Group_Has_One_Role_Only(){
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

        // grant to the group a new profile
        $group->roles()->attach($testPrimaryKey);

        $this->assertDatabaseHas('grupo_perfil', [
            'ID_GRUPO' => $testPrimaryKey, 'ID_PERFIL' => $testPrimaryKey
        ]);

	$this->assertNotRepeatedQueries();
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
            'Nombre' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);

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

	public function test_Administration_Role_Cant_be_deleted(){
        $this->expectException(EntityException::class);

        $role = Role::find(0);
        $role->delete();
    }
}
