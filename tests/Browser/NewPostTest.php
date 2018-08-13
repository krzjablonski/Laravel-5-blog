<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;
use App\User;

class NewPostTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_new_post()
    {
        $this->browse(function (Browser $browser) {
          $faker = Faker::create();
          $title = $faker->sentence();
          $slug = str_replace(' ', '-', $title);
          $browser->loginAs(User::find(2))
                  ->visit('/posts/create')
                  ->assertSee('Create New Post')
                  ->type('title', $title)
                  ->type('slug', $slug)
                  ->type('body', $faker->paragraphs(5, true))
                  ->select('category_id')
                  ->script('jQuery(".select2").val(["1","2"]).trigger("change");');

          $browser->click('input[type=submit]#submit')
                  ->assertSee('Error:');
        });
    }
}
