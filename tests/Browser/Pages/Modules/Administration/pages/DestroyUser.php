<?php

namespace Tests\Browser\Pages\Modules\Administration\pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class DestroyUser extends Page
{
    private $id;

    public function __construct($id)
    {
        echo '__construct: '.$id.PHP_EOL;
        $this->id = $id;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {$r = route('admin.users.destroy', ['id' => $this->id], false);
        echo 'url: '.$r.PHP_EOL;
        return $r;
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
            '@dusk-click-show'     => "a[data-dusk='dusk-click-show']",
            '@dusk-click-edit'     => "a[data-dusk='dusk-click-edit']",
            '@dusk-button-destroy' => "button[data-dusk='dusk-button-destroy']",
        ];
    }
}
