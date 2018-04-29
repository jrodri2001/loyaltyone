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
        $response = $this->post('/api/submission', [
            'text'=>$test_text,
            'username'=>'tester'
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(['status'=>"ok"]);
        
        $this->assertDatabaseHas('submissions', [
            'text' => $test_text
        ]);
        
        //delete the test record
        $s = Submission::where('text', '=', $test_text)->delete();
        
    }
    
    public function testGetSubmissionsByName(){
        $tester_user = '_tester_';
        //delete any submission with tester user
        Submission::where('username', '=', $tester_user)->delete();
        
        //lets insert some submissions
        $submissions = factory(Submission::class, 3)->make()->toArray();
        
        foreach($submissions as $s){
            $this->assertArrayHasKey('username', $s);
            $this->assertEquals($tester_user, $s['username']);
            
            //persist in the database
            Submission::create($s);
        }
        
        //check that the api retrieves this 3 records
        $response = $this->get('/api/submission/username/' . $tester_user);
        $response->assertJsonCount(3);
    
        Submission::where('username', '=', $tester_user)->delete();
        
    }
    
    
    public function testGetAllSubmissions(){
        //get all the current submissions
        $response = $this->get('/api/submission');
        
        //count DB submissions
        $count = Submission::all()->count();
        
        //Assert count
        $response->assertJsonCount($count);
    }
}
