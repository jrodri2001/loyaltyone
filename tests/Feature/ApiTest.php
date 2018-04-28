<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * Lets test the api, text sent to this api should return the same parameter sent.
     *
     * @return void
     */
    public function testApi()
    {
        $text = "Test";
        
        $response = $this->get('/api/' . $text);
    
        $response
            ->assertStatus(200)
            ->assertSeeText($text);
    }
}
