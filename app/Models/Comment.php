<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $with = ['user','post'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function reply():HasMany{
        return $this->hasMany(Reply::class);
    }

    public function report():HasMany{
        return $this->hasMany(Report::class);
    }
}
