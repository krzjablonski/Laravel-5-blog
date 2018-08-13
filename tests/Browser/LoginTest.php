<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LoginTest extends DuskTestCase
{
    // * @test */
    public function test_login()
    {
      $this->browse(function (Browser $browser) {
          $browser->visit('/login')
                  ->value('#email', 'test@example.com')
                  ->value('#password', 'testpass')
                  ->click('button[type=submit]')
                  ->assertPathIs('/posts');
      });
    }
}
