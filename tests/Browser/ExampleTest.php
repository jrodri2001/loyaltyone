<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * Testing Done Button call gets a valid response.
     *
     * @return void
     */
    public function testDoneButton()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('text', "testing")
                    ->press('Done')
                    ->waitForText('testing')
                    ->with('#response', function($element){
                        $element->assertSee('testing');
                    });
        });
    }
}
