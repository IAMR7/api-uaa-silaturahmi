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
            $user = Auth::user();
            $token = $user->createToken($user->username . ' Access Token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function generateToken(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
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
        $user->avatar = "default_avatar.png";
        $user->role_id = 2;


        if ($user->save()) {
            $response = ([
                "success" => "User Added Successfully.",
                "user" => $user,
                'token' => $user->createToken($user->username . ' Access Token')->plainTextToken
            ]);
            return response($response, 201);
        }

        return response(["error" => "Failed to create user. Please try again."], 203);

    }
}
