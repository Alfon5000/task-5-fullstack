<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);

        if ($posts->count() < 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Posts are empty.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image',
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();
        $validated['image'] = $request->file('image')->store('post-images');
        $post = Post::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Post has been created.',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found.'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image',
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        Storage::disk('public')->delete($post->image);
        $validated = $validator->validated();
        $validated['image'] = $request->file('image')->store('post-images');
        $post->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Post has been updated.',
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found.'
            ], 404);
        }

        Storage::disk('public')->delete($post->image);
        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Post has been deleted.'
        ]);
    }
}
