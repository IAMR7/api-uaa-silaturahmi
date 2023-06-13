<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;

class FriendshipsController extends Controller
{
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
