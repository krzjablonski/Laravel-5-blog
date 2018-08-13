<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/Register')
                    ->value('#name', 'TestUser')
                    ->value('#email', 'test@email.com')
                    ->value('#password', 'testpass')
                    ->value('#password-confirm', 'testpass')
                    ->click('button[type=submit]')
                    ->assertPathIs('/posts');
        });
    }
}
