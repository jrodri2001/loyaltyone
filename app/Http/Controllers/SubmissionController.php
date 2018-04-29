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
    
    public function indexByUser(Request $request, $username){
        return Submission::where('username', '=', $username)->get();
    }
    
    public function show($id)
    {
        return Submission::find($id);
    }
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => "required",
            'username' => "required"
        ]);
        
        $text = $request->input('text');
        $username = $request->input('username');
        
        if (!$text || !$username) {
            return $this->sendResponse("fail", 'Missing parameter');
        }
        
        $submission = Submission::create([
            'text' => $text,
            'username' => $username
        ]);
        
        if (!$submission) {
            return $this->sendResponse("fail", 'Error creating model');
        }
        
        $models = Submission::where('username', '=', $username)->orderby('created_at','desc')->get()->toArray();
        return $this->sendResponse('ok', 'Submission Saved', $models);
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
    
    private function sendResponse($status, $message = null, $data = null)
    {
        $response = [
            "status" => $status
        ];
        
        if ($message) {
            $response['message'] = $message;
        }
        
        if ($data){
            $response['data'] = $data;
        }
        
        return json_encode($response);
    }
}
