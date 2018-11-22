<?php

namespace Tests\Browser\Pages\Modules\Administration\pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class CreateUser extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return route('admin.users.create', [], false);
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@login'   => "input[name='login']",
            '@name'    => "input[name='name']",
            '@surname' => "input[name='surname']",
            '@dusk-button-submit' => "button[data-dusk='dusk-button-submit']",
        ];
    }
}
