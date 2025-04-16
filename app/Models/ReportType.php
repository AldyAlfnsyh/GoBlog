<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportType extends Model
{
    protected $guarded = [];
    
    public function report():HasMany{
        return $this->hasMany(Report::class);
    }
}
