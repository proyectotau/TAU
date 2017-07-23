<?php

namespace Tests\Module;

use Tests\TestCase;
use Nwidart\Modules\Facades\Module;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;

class ModuleTest extends TestCase
{
    use DatabaseTransactions;

    private $debug = false;

    private $testPrimaryKey = 1;
    private $testUserName = 'juan.espanol';
    private $testName = 'Juan';
    private $testLastName = 'Espanol';

    private $testGroupName = 'Test';
    private $testGroupDescription = 'Group for Testing';

   public function test_Administration_module_exists()
    {
        $admin = Module::find('Administration');

        $this->assertNotNull($admin, 'Administration module does not exist');
    }

    // TODO: Move to TAU/Modules/Administration/Tests
    public function test_create_User_Entity()
    {
        $user = factory(User::class)->create([
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $this->assertNotNull($user, 'Can not create Administration\Entities\User');

        $this->assertDatabaseHas('usuario', [
            'ID_USUARIO' => $this->testPrimaryKey,
            'USUARIO_RED' => $this->testUserName,
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
    }

    // TODO: Move to TAU/Modules/Administration/Tests
    public function test_create_Group_Entity()
    {
        $group = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName,
            'DESCRIPCION' => $this->testGroupDescription
        ]);
        if( $this->debug ) {
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
            'NOMBRE' => $this->testName,
            'APELLIDOS' => $this->testLastName
        ]);
        if ($this->debug) {
            dd(User::find($this->testPrimaryKey));
        }

        $this->assertDatabaseMissing('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey
        ]);
    }

    public function test_User_BelongsTo_A_One_Group_Only(){
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

    public function test_User_HasMany_Groups(){
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

        $groupA = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName.'A',
            'DESCRIPCION' => $this->testGroupDescription.'A'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey,
            'NOMBRE' => $this->testGroupName.'A',
            'DESCRIPCION' => $this->testGroupDescription.'A'
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey));
        }
        $groupB = factory(Group::class)->create([
            'ID_GRUPO' => $this->testPrimaryKey+1,
            'NOMBRE' => $this->testGroupName.'B',
            'DESCRIPCION' => $this->testGroupDescription.'B'
        ]);
        $this->assertDatabaseHas('grupo', [
            'ID_GRUPO' => $this->testPrimaryKey+1,
            'NOMBRE' => $this->testGroupName.'B',
            'DESCRIPCION' => $this->testGroupDescription.'B'
        ]);
        if ($this->debug) {
            dd(Group::find($this->testPrimaryKey+1));
        }

        // add relations
        $user->groups()->attach($groupA->ID_GRUPO);
        $user->groups()->attach($groupB->ID_GRUPO);
        //$user->groups()->attach($this->testPrimaryKey);
        //$user->groups()->attach($this->testPrimaryKey+1);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey,
            'ID_USUARIO' => $this->testPrimaryKey, 'ID_GRUPO' => $this->testPrimaryKey+1
        ]);
    }

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

    /*public function test_Group_HasMany_Users(){ // TODO:
        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => 1,
            'ID_GRUPO' => 1
        ]);

        $this->assertDatabaseHas('usuario_grupo', [
            'ID_USUARIO' => 1,
            'ID_GRUPO' => 2
        ]);
    }*/
}
