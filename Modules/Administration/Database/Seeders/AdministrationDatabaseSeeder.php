<?php

namespace Modules\Administration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;

class AdministrationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        factory(User::class,3)->create();
        factory(Group::class,5)->create();
    }
}
