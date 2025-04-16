<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    //
    protected $fillable =['user_id', 'post_id', 'type'];
    protected $with = ['user','post'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
