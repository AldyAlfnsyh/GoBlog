<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    //
    public function type():BelongsTo{
        return $this->belongsTo(ReportType::class);
    }
    public function reply():BelongsTo{
        return $this->belongsTo(Reply::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function comment():BelongsTo{
        return $this->belongsTo(Comment::class);
    }
    public function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }
}
