<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'data'      => $post,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $post           = new Post();
            $post->title    = $request->title;
            $post->body     = $request->body;

            if ($post->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post created successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post           = Post::findOrFail($id);
            $post->title    = $request->title;
            $post->body     = $request->body;

            if ($post->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post updated successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $post           = Post::findOrFail($id);

            if ($post->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post deleted successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
