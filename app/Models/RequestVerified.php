<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestVerified extends Model
{
    use HasFactory;
    protected $table = "request_verifieds";

    public function user()
    {
        return $this->belongsTo(User::class)->with('role', 'major', 'status');
    }
}
