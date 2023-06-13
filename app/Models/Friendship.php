<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->with('role', 'major', 'status');
    }

    public function friendUser()
    {
        return $this->belongsTo(User::class)->with('role', 'major', 'status');
    }
}
