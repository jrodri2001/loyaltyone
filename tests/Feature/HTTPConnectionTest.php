<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HTTPConnectionTest extends TestCase
{
    /**
     * Check if Homepage is loading
     *
     * @return void
     */
    public function testHomeStatus()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
