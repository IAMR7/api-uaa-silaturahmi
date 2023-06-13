<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UsersController extends Controller
{
    public function detail($id)
    {
        $user = User::with('role', 'major', 'status')->find($id);
        return response()->json(
            [
                'user' => $user
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'email' => 'email',
            'phone' => 'numeric',
        ];

        $messages = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'regex' => ':attribute harus terdiri dari huruf dan angka',
            'alpha' => ':attribute hanya boleh huruf',
            'email' => ':attribute tidak valid',
            'numeric' => ':attribute hanya boleh angka'
        ];

        $isValid = Validator::make($request->json()->all(), $rules, $messages);
        if ($isValid->fails()) {
            return response(['error' => ($isValid->errors()->getMessageBag())], 203);
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->gender = $request->gender;
        $user->major_id = $request->major_id;
        $user->status_id = $request->status_id;
        $user->avatar = $request->avatar;
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        if ($user->save()) {
            return response()->json(
                [
                    'message' => 'Profil berhasil diedit',
                    'user' => $user,
                ],
                201
            );
        }

        return response(["error" => "Update profil gagal, coba lagi"], 203);

    }

    public function updatePassword(Request $request, $id)
    {
        $rules = [
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/',
        ];

        $messages = [
            'required' => ':attribute harus diisi',
            'regex' => ':attribute harus terdiri dari huruf dan angka',
        ];

        $isValid = Validator::make($request->json()->all(), $rules, $messages);
        if ($isValid->fails()) {
            return response(['error' => ($isValid->errors()->getMessageBag())], 203);
        }

        $user = User::find($id);

        $user->password = bcrypt($request->password);
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        if ($user->save()) {
            return response()->json(
                [
                    'message' => 'Yeay! password berhasil diedit',
                    'user' => $user,
                ],
                201
            );
        }

        return response(["error" => "Update password gagal, coba lagi"], 203);

    }
}
