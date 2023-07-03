<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use Validator;

class UsersController extends Controller
{

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::with('role', 'major', 'status')->where('name', 'LIKE', '%' . $searchTerm . '%')->get();

        return response()->json($users, 200);
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
        $user->updated_at = now();

        if (!isset($request->avatar)) {

            Storage::delete('public/uploads/avatars/' . $user->avatar);
            $user->avatar = NULL;
      
          } else {
      
            if ($request->hasFile('avatar')) {
      
              if (isset($user->avatar)) {
                Storage::delete('public/uploads/avatars/' . $user->avatar);
              }
      
              $avatar = $request->file('avatar');
              $avatarName = time() . '_' . $avatar->getClientOriginalName();
              $photo = $avatar->storeAs('public/uploads/avatars', $avatarName);
              $user->avatar = $avatarName;
      
            }
      
        }

        if (!isset($request->cover)) {

            Storage::delete('public/uploads/covers/' . $user->cover);
            $user->cover = NULL;
           
      
          } else {
      
            if ($request->hasFile('cover')) {
      
              if (isset($user->cover)) {
                Storage::delete('public/uploads/covers/' . $user->cover);
              }
      
              $cover = $request->file('cover');
              $coverName = time() . '_' . $cover->getClientOriginalName();
              $photo = $cover->storeAs('public/uploads/covers', $coverName);
              $user->cover = $coverName;
      
            }
      
        }

        $user->save();
        

        return response()->json(
            [
                'message' => 'Yeay! profil berhasil diedit',
                'user' => $user,
            ],
            201
        );

    }
}
