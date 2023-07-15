<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Friendship;
use Validator;
use Storage;

class PostsController extends Controller
{
    public function index($id)
    {   

        $friendships = Friendship::with('user', 'friendUser')
        ->where(function ($query) use ($id) {
            $query->where('user_id', $id)
                ->orWhere('friend_user_id', $id);
        })
        ->where('status', 'Diterima')
        ->get();

        $friendUserIds = [$id];

        foreach ($friendships as $friendship) {
            $friendUserIds[] = $friendship->user_id;
            $friendUserIds[] = $friendship->friend_user_id;
        }

        $posts = Post::with('user', 'comment', 'like')
        ->whereIn('user_id', $friendUserIds)
        ->get()->sortByDesc('created_at')->values();

        return response()->json($posts, 200);

    }

    public function getPosts()
    {
        $posts = Post::with('user', 'comment', 'like')->paginate(10);
        return response($posts, 200);
    }

    public function userPosts($id)
    {
        $posts = Post::with('user', 'comment', 'like')->where('user_id', '=', $id)->get()->sortByDesc('created_at')->values();
        return response()->json($posts, 200);
    }

    public function detail($id)
    {
        $post = Post::with('user', 'comment', 'like')->find($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->user_id = $request->user_id;
        $post->content = $request->content;
        $post->created_at = now();
        $post->updated_at = now();

        if (!isset($request->image)) {

            Storage::delete('public/uploads/posts/' . $user->image);
            $user->image = NULL;
           
      
          } else {
      
            if ($request->hasFile('image')) {
      
              if (isset($user->image)) {
                Storage::delete('public/uploads/posts/' . $user->image);
              }
      
              $image = $request->file('image');
              $imageName = time() . '_' . $image->getClientOriginalName();
              $photo = $image->storeAs('public/uploads/posts', $imageName);
              $post->image = $imageName;
      
            }
      
        }

        // return response($post);

        $post->save();

        return response()->json(
            [
                'message' => 'Yeay! Postingan berhasil dibuat',
                'post' => $post,
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->user_id = $request->user_id;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->created_at = now();
        $post->updated_at = now();

        $post->save();

        return response()->json(
            [
                'message' => 'Postingan berhasil diedit',
                'post' => $post,
            ],
            201
        );
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(
            [
                'message' => 'Postingan berhasil dihapus',
                'post' => $post,
            ],
            200
        );
    }
}
