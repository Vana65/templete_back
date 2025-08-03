<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        Comment::create($data);
                    return back()->with("CommentCreateStatus", "Comment Added Successfully");

    }
}
