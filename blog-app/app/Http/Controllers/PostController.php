<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->paginate(5);
        $count = $posts->count();
        return view('posts.index', compact(['posts', 'count']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::where('user_id', $request->user()->id)->get();
        return view('posts.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        $validatedData['image'] = $request->file('image')->store('post-images');
        Post::create($validatedData);
        return redirect('/posts')->with('created', 'Post has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post)
    {
        $categories = Category::where('user_id', $request->user()->id)->where('id', '!=', $post->category->id)->get();
        return view('posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        Storage::disk('public')->delete($post->image);
        $validatedData['image'] = $request->file('image')->store('post-images');
        $post->update($validatedData);
        return redirect('/posts')->with('updated', 'Post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect('/posts')->with('deleted', 'Post has been deleted.');
    }
}
