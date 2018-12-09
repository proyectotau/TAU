<?php

namespace Tests\Browser\Modules\Administration;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Browser\Pages\Modules\Administration\pages\{
    IndexUser, CreateUser, DestroyUser
};

class UserViewsTest extends DuskTestCase
{
    //use DatabaseMigrations;
    use DatabaseTransactions;

    public function skip_test_createuser_view()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateUser())
                    ->assertPresent('@login')
                    ->assertPresent('@name')
                    ->assertPresent('@surname')
                    ->type('@login', 'john.doe')->assertInputValue('@login', 'john.doe')
                    ->type('@name', 'John')->assertInputValue('@name', 'John')
                    ->type('@surname', 'Doe')->assertInputValue('@surname', 'Doe')
                    ->press('@dusk-button-submit')
                    ->on(new IndexUser())
                    ->assertSee('john.doe')
                    ->assertSee('John')
                    ->assertSee('Doe');
        });
    }

    public function test_indexuser_view()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new IndexUser())
                ->assertSee('Id')
                ->assertSee('Login as')
                ->assertSee('Name')
                ->assertSee('Surname')
                ->assertSee('Actions');
        });
    }

    public function test_destroyuser_view()
    {
        $this->browse(function (Browser $browserCreate, Browser $browserDestroy) {
            $browserCreate->visit(new CreateUser())
                ->assertPresent('@login')
                ->assertPresent('@name')
                ->assertPresent('@surname')
                ->type('@login', 'john.doe')->assertInputValue('@login', 'john.doe')
                ->type('@name', 'John')->assertInputValue('@name', 'John')
                ->type('@surname', 'Doe')->assertInputValue('@surname', 'Doe')
                ->press('@dusk-button-submit')
                ->on(new IndexUser())
                //->waitFor('@dusk-button-destroy', 600)
                ->assertSee('john.doe')
                ->assertSee('John')
                ->assertSee('Doe')
                ->press('@dusk-button-destroy')
                ->on(new IndexUser())
                ->assertDontSee('john.doe')
                ->assertDontSee('John')
                ->assertDontSee('Doe');
        });
    }

    public function skip_test_last_id(){
        $this->browse(function (Browser $browser){
            $browser->visit(new IndexUser())
                ->assertSeeIn('@dusk-last-id', '1')
                ;
        });
    }
}
