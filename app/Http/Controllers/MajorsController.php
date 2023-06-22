<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class MajorsController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return response()->json($majors, 200);
    }
}
