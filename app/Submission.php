<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = "submissions";
    
    protected $fillable = ['text','username', 'parent_id'];
    
    
    public function replies()
    {
        return $this->hasMany('App\Submission', 'parent');
    }
    
    public function allReplies()
    {
        return $this->replies()->with(__FUNCTION__);
    }
    
    public function owner()
    {
        return $this->belongsTo('App\Submission', 'parent');
    }
}
