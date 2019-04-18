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

class UserEntityTest extends TestCase
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

    public function test_create_User_Entity()
    {
        $testPrimaryKey = $this->testPrimaryKey;

        $user = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);

        $this->assertNotNull($user, 'Can not create Administration\Entities\User');

        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_update_User_Entity()
    {
        $this->withoutExceptionHandling();

        $testPrimaryKey = $this->testPrimaryKey;

        $user = factory(User::class)->create([
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testFirstName,
            'APELLIDOS' => $this->testLastName
        ]);

        $this->assertNotNull($user, 'Can not create Administration\Entities\User');

        $user = $user->find($testPrimaryKey);
        $user->login =$this->testUserName.'X';
        $user->name =$this->testFirstName.'X';
        $user->surname = $this->testLastName.'X';

        $user->update();

        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $testPrimaryKey,
            'USUARIO_RED' => $this->testUserName.'X',
            'NOMBRE' => $this->testFirstName.'X',
            'APELLIDOS' => $this->testLastName.'X'
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_User_BelongsTo_No_Group()
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

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey
        ]);

        $this->assertNotRepeatedQueries();
    }

    public function test_User_BelongsTo_One_Group_Only()
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

        // add user membership
        $user->groups()->attach($group->ID_GRUPO); // $testPrimaryKey

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
        ]);

        $this->assertDatabaseCountExpected('usuario_grupo', 1, [
            'ID_USUARIO' => $testPrimaryKey,
        ]);

        $this->assertNotRepeatedQueries();
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

        $groupA = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName.'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey,
            'NOMBRE' => $this->testGroupName.'A',
            'DESCRIPCION' => $this->testGroupDescription . 'A'
        ]);

        $groupB = factory(Group::class)->create([
            'ID_GRUPO' => $testPrimaryKey+1,
            'NOMBRE' => $this->testGroupName. 'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $testPrimaryKey+1,
            'NOMBRE' => $this->testGroupName.'B',
            'DESCRIPCION' => $this->testGroupDescription . 'B'
        ]);

        //TODO FAIL here $this->assertNotRepeatedQueries();

        // add relations users belongs to group
        $user->groups()->attach([
			$groupA->ID_GRUPO,  // $testPrimaryKey
        	$groupB->ID_GRUPO,  // $testPrimaryKey + 1
		]);
        
        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey,
            'ID_USUARIO' => $testPrimaryKey, 'ID_GRUPO' => $testPrimaryKey + 1
        ]);

        $this->assertDatabaseCountExpected('usuario_grupo', 2, [
            'ID_USUARIO' => $testPrimaryKey,
        ]);

        // $this->assertNotRepeatedQueries(); // TODO uncomment when it does't fail
    }

    public function test_Administrator_User_Cant_be_deleted(){
        $this->expectException(EntityException::class);

        $user = User::find(0);
        $user->delete();
    }
}
