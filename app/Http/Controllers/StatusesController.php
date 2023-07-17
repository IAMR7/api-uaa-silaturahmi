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

    public function detail($id)
    {
        $status = Status::find($id);
        return response()->json($status, 200);
    }

    public function store(Request $request)
    {
        $status = new Status();
        $status->status = $request->status;

        $status->save();

        return response()->json(
            [
                "message" => "berhasil tambah status user",
                "status" => $status
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $status = Status::find($id);
        $status->status = $request->status;

        $status->save();

        return response()->json(
            [
                "message" => "berhasil ubah status user",
                "status" => $status
            ]
        );
    }

    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();

        return response()->json(
            [
                "message" => "berhasil hapus status user",
                "status" => $status
            ]
        );
    }
}
