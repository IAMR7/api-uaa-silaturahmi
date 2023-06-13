<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        $like = new Like();

        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;
        $like->created_at = now();
        $like->updated_at = now();

        $like->save();

        return response()->json(
            [
                'message' => 'Yeay! like berhasil dibuat',
                'like' => $like,
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $like = Like::find($id);

        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;
        $like->created_at = now();
        $like->updated_at = now();

        $like->save();

        return response()->json(
            [
                'message' => 'Yeay! like berhasil diubah',
                'like' => $like,
            ],
            201
        );
    }

    public function destroy($id)
    {
        $like = Like::find($id);
        $like->delete();
        return response()->json(
            [
                'message' => 'Yeay! komentar berhasil dihapus',
                'like' => $like,
            ],
            200
        );
    }
}
