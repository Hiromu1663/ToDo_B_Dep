<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'contents',
        'image_at',
        'user_id',
        'date',
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
}
