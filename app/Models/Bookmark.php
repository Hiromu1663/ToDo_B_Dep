<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
    
    public function task()
    {
        return $this->belongsTo("App\Models\Task");
    }
}
