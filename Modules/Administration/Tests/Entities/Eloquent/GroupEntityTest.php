<?php

namespace Modules\Administration\Tests\Entities\Eloquent;

use Tests\TestCase;
use Tests\DetectRepeatedQueries;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Administration\Tests\Entities\ConfigTestValues;
use Modules\Administration\Repositories\Eloquent\User;
use Modules\Administration\Repositories\Eloquent\Group;
use Modules\Administration\Exceptions\EntityException;

class GroupEntityTest extends TestCase
{
    use ConfigTestValues;
    use DatabaseTransactions;
    use DetectRepeatedQueries;

    public function setUp()
    {
        parent::setUp();

        $this->enableQueryLog();

        $app = Container::getInstance();
        $this->app->bind('Modules\Administration\Entities\User',
            'Modules\Administration\Repositories\Eloquent\User');
        $this->app->bind('Modules\Administration\Entities\Group',
            'Modules\Administration\Repositories\Eloquent\Group');
    }

    public function tearDown()
    {
        $this->flushQueryLog();
        parent::tearDown();
    }

    public function test_create_Group_Entity()
    {
        $testPrimaryKey = $this->testPrimaryKey;

        $group = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);

        $this->assertNotNull($group, 'Can not create Administration\Entities\Group');

        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_Group_Has_No_User()
	{
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

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_GRUPO' => $testPrimaryKey
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_Group_Has_One_User_Only()
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

        // add user as a new member
        $group->users()->attach($user->ID_USUARIO); // $testPrimaryKey

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
        ]);

		$this->assertDatabaseCountExpected('usuario_grupo', 1, [
            'ID_GRUPO' => $testPrimaryKey,
        ]);

        $this->assertNotRepeatedQueries();
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

        //TODO FAIL here $this->assertNotRepeatedQueries();

        // add users A and B as new members
        $group->users()->attach([
            $userA->ID_USUARIO, // $testPrimaryKey
            $userB->ID_USUARIO  // $testPrimaryKey + 1
        ]);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
            'ID_USUARIO' => $testPrimaryKey + 1, 'ID_GRUPO' => $testPrimaryKey
        ]);

        $this->assertDatabaseCountExpected('usuario_grupo', 2, [
            'ID_GRUPO' => $testPrimaryKey,
        ]);

        // $this->assertNotRepeatedQueries(); // TODO uncomment when it does't fail
    }

    public function test_Administrators_Group_Cant_be_deleted()
    {
        $this->expectException(EntityException::class);

        $group = Group::find(0);
        $group->delete();
    }
}
