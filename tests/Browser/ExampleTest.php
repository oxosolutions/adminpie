<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        //$this->route('GET', 'org.login');
        //$this->assertResponseOk();
        $this->browse(function (Browser $browser) {
            dd($browser->visit('http://master.scolm.com/login')
                    ->assertSee('Login'));
        });
    }
}
