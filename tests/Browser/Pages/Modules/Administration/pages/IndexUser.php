<?php

namespace Tests\Browser\Pages\Modules\Administration\pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class IndexUser extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return route('admin.users.index', [], false);
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
            '@dusk-link-show'      => "a[data-dusk='dusk-link-show']",
            '@dusk-link-edit'      => "a[data-dusk='dusk-link-edit']",
            '@dusk-button-destroy' => "button[data-dusk='dusk-button-destroy']",
            '@dusk-last-id'        => "tbody tr:last-child td",
        ];
    }
}
