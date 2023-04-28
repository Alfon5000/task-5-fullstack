<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')->orWhere('content', 'like', '%' . $request->search . '%')->paginate(6);
        } else {
            $posts = Post::latest()->paginate(6);
        }

        $count = $posts->count();
        return view('index', compact(['posts', 'count']));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact(['post']));
    }
}
