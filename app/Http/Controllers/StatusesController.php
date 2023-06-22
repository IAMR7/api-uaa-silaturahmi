<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Status;

class StatusesController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return response()->json($statuses, 200);
    }
}
