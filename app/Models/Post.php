<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    public function user()
    {
        return $this->belongsTo(User::class)->with('role', 'major', 'status');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class)->with('user');
    }

    public function like()
    {
        return $this->hasMany(Like::class)->with('user');
    }
}
