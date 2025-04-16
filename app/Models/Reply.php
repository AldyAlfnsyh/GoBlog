<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reply extends Model
{
    protected $with = ['user', 'comment', 'post'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function reply(){
        return $this->hasOne(Post::class);
    }

    public function report():HasMany{
        return $this->hasMany(Report::class);
    }
}
