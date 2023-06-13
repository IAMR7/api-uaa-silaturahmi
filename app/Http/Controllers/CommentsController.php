<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();

        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->image = $request->image;
        $comment->created_at = now();
        $comment->updated_at = now();

        $comment->save();

        return response()->json(
            [
                'message' => 'Yeay! komentar berhasil dibuat',
                'comment' => $comment,
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->image = $request->image;
        $comment->created_at = now();
        $comment->updated_at = now();

        $comment->save();

        return response()->json(
            [
                'message' => 'Yeay! komentar berhasil diubah',
                'comment' => $comment,
            ],
            201
        );
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(
            [
                'message' => 'Yeay! komentar berhasil dihapus',
                'comment' => $comment,
            ],
            200
        );
    }
}
