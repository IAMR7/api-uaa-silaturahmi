<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user()->load('role', 'major', 'status');
            $token = $user->createToken($user->username . ' Access Token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 203);
    }

    public function generateToken(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function register(Request $request)
    {

        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/',
            'gender' => 'required',
        ];
        $messages = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'regex' => ':attribute harus terdiri dari huruf dan angka',
            'alpha' => ':attribute hanya boleh huruf',
            'email' => ':attribute tidak valid'
        ];

        $isValid = Validator::make($request->json()->all(), $rules, $messages);
        if ($isValid->fails()) {
            return response(['error' => ($isValid->errors()->getMessageBag())], 203);
        }

        $body = (object) $request->json()->all();
       
        /**
         * Create user
         */

        $user = new User();
        $user->name = $body->name;
        $user->username = $body->username;
        $user->email = $body->email;
        $user->password = bcrypt($body->password);
        $user->gender = $body->gender;
        $user->major_id = $body->major_id;
        $user->status_id = $body->status_id;
        $user->year_generation = $body->year_generation;
        $user->role_id = 2;


        if ($user->save()) {
            $response = ([
                "success" => "Hore, kamu berhasil daftar",
                "user" => $user,
                // 'token' => $user->createToken($user->username . ' Access Token')->plainTextToken
            ]);
            return response($response, 201);
        }

        return response(["error" => "Gagal registrasi, yuk ulangi"], 203);

    }
}
