<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:3|max:1000',
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:100',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = Comment::create([
            'content' => $request->content,
            'name' => $request->name,
            'email' => $request->email,
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
            'parent_id' => $request->parent_id
        ]);

        // Load relationships for AJAX response
        if ($comment->parent_id) {
            $comment->load('parent');
        }

        if ($request->ajax()) {
            $commentHTML = view('frontend.comment', ['comment' => $comment])->render();
            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully!',
                'comment' => $commentHTML,
                'parent_id' => $comment->parent_id,
                'comment_id' => $comment->id
            ]);
        }

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function getComments(Post $post)
    {
        $comments = $post->comments()->with('replies')->get();
        
        $commentsHTML = '';
        foreach ($comments as $comment) {
            $commentsHTML .= view('frontend.comment', ['comment' => $comment])->render();
        }
        
        return response()->json([
            'comments' => $commentsHTML
        ]);
    }
}
