<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)
                    ->withCount('comments')
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);
        
        // This should point to your existing blog file
        return view('frontend.blog', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('published', true)
                    ->with(['comments' => function($query) {
                        $query->with('replies')->orderBy('created_at', 'desc');
                    }])
                    ->firstOrFail();
        
        // This should point to your existing blog detail file
        return view('frontend.shows', compact('post'));
    }
}