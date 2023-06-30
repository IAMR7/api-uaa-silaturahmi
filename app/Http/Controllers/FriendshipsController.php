<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;

class FriendshipsController extends Controller
{
    public function friendUsers($id)
    {
        // $friendships = Friendship::with('user', 'friendUser')
        // ->where('user_id', '=', $id)
        // ->where('status', '=', "Diterima")
        // ->get();

        $friendships = Friendship::with('user', 'friendUser')
        ->where(function ($query) use ($id) {
            $query->where('user_id', $id)
                ->orWhere('friend_user_id', $id);
        })
        ->where('status', 'Diterima')
        ->get();

        return response()->json(
            $friendships,
            200
        );
    }

    // public function myFriends($id)
    // {
    //     $friendships = Friendship::with('user', 'friendUser')
    //     ->where('user_id', '=', $id)
    //     ->where('status', '=', "Diterima")
    //     ->get();

    //     return response()->json(
    //         $friendships,
    //         200
    //     );
    // }

    public function accFriend($id)
    {
        $friendships = Friendship::with('user', 'friendUser')
        ->where('friend_user_id', '=', $id)
        ->where('status', '=', "Menunggu Konfirmasi")
        ->get();

        return response()->json(
            $friendships,
            200
        );
    }

    public function store(Request $request)
    {
        $friendship = new Friendship();

        $friendship->user_id = $request->user_id;
        $friendship->friend_user_id = $request->friend_user_id;
        $friendship->status = $request->status;
        $friendship->created_at = now();
        $friendship->updated_at = now();

        $friendship->save();

        return response()->json(
            [
                'message' => 'Yeay! Friendship berhasil dibuat',
                'friendship' => $friendship,
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $friendship = Friendship::with('user', 'friendUser')->find($id);

        $friendship->user_id = $request->user_id;
        $friendship->friend_user_id = $request->friend_user_id;
        $friendship->status = $request->status;
        $friendship->created_at = now();
        $friendship->updated_at = now();

        $friendship->save();

         return response()->json(
            [
                'message' => 'Yeay! Friendship berhasil diubah',
                'friendship' => $friendship,
            ],
            201
        );
    }
}
