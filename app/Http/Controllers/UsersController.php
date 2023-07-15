<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use Validator;

class UsersController extends Controller
{

  public function index()
  {
    $users = User::with('role', 'major', 'status')->paginate(10);
    return response($users, 200);
  }

  public function search(Request $request)
  {
    $searchTerm = $request->input('search');
    $users = User::with('role', 'major', 'status')->where('name', 'LIKE', '%' . $searchTerm . '%')->get();
    return response()->json($users, 200);
  }

  public function getUser($id)
  {
      $user = User::with('role', 'major', 'status')->find($id);
      return response()->json($user, 200);
    }

    public function updatePassword(Request $request, $id)
    {
      $rules = [
        'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/',
      ];

      $messages = [
        'required' => ':attribute harus diisi',
        'regex' => ':attribute harus terdiri dari huruf dan angka'
      ];

      $isValid = Validator::make($request->json()->all(), $rules, $messages);
      if ($isValid->fails()) {
          return response(['error' => ($isValid->errors()->getMessageBag())], 203);
      }

      $user = User::find($id);
      $user->password = bcrypt($request->password);

      $user->save();
      $user = User::with('role', 'major', 'status')->find($id);
        
      return response()->json(
        [
          'message' => 'Yeay! password berhasil diedit',
          'user' => $user,
        ],
        201
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
        $user->major_id = (int) $request->major_id;
        $user->status_id = (int) $request->status_id;
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
        $user = User::with('role', 'major', 'status')->find($id);
        

        return response()->json(
            [
                'message' => 'Yeay! profil berhasil diedit',
                'user' => $user,
            ],
            201
        );

    }
}
