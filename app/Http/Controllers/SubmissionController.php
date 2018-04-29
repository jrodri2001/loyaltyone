<?php

namespace App\Http\Controllers;

use App\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    
    public function view(Request $request, $id)
    {
        return $id;
    }
    
    public function index()
    {
        return Submission::all();
    }
    
    public function show($id)
    {
        return Submission::find($id);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, ['text'=>"required"]);
        
        $text = $request->input('text');
        if (!$text){
            return $this->sendResponse("fail", 'Missing parameter');
        }
        $submission = Submission::create(['text'=>$text]);
        
        if (!$submission){
            return $this->sendResponse("fail", 'Error creating model');
        }
        return $this->sendResponse('ok');
    }
    
    public function update(Request $request, $id)
    {
        $article = Submission::findOrFail($id);
        $article->update($request->all());
        
        return $article;
    }
    
    public function delete(Request $request, $id)
    {
        $article = Submission::findOrFail($id);
        $article->delete();
        
        return 204;
    }
    
    private function sendResponse($status, $message = null){
        $response = [
            "status"=>$status
        ];
        
        if ($message){
            $response['message'] = $message;
        }
        
        return json_encode($response);
    }
}
