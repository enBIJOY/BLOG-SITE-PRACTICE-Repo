<?php

namespace App\Http\Controllers;

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

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
