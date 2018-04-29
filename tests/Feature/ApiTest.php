<?php

namespace Tests\Feature;

use App\Submission;
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
        
        $response = $this->get('/api/submission/');
    
        $response->assertStatus(200);
    }
    
    
    public function testSaveSubmission(){
        
        $test_text = 'testing' . uniqid();
        $response = $this->post('/api/submission', ['text'=>$test_text]);
        $response
            ->assertStatus(200)
            ->assertJson(['status'=>"ok"]);
        
        $this->assertDatabaseHas('submissions', [
            'text' => $test_text
        ]);
        
        //delete the test record
        $s = Submission::where('text', '=', $test_text)->delete();
        
    }
}
