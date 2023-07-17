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

    public function detail($id)
    {
        $major = Major::find($id);
        return response()->json($major, 200);
    }

    public function store(Request $request)
    {
        $major = new Major();

        $major->major = $request->major;
        $major->created_at = now();
        $major->updated_at = now();

        $major->save();

        return response()->json(
            [
                "message" => "Berhasil tambah jurusan",
                "major" => $major
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $major = Major::find($id);

        $major->major = $request->major;
        $major->updated_at = now();

        $major->save();

        return response()->json(
            [
                "message" => "Berhasil ubah jurusan",
                "major" => $major
            ],
            201
        );
    }

    public function destroy($id)
    {
        $major = Major::find($id);

        $major->delete();

        return response()->json(
            [
                "message" => "Berhasil hapus jurusan",
                "major" => $major
            ],
            200
        );
    }
}
