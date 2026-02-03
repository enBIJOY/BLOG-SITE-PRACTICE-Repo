<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function index()
    // {
    // $posts = Post::latest()->get();
    // return view('frontend.latestNews', compact('posts'));
    // }
    // public function show($id)
    // {
    // $post = Post::findOrFail($id);
    // return view('blog.details', compact('post'));
    // }

    public function index()
    {
        $posts = Post::withCount('comments')
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);
        
        return view('frontend.blogs', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->with(['comments' => function($query) {
                        $query->with('replies');
                    }])
                    ->firstOrFail();
        
        return view('frontend.shows', compact('post'));
    }
}
