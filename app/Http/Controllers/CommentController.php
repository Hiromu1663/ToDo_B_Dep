<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function createComment($task_id)
  {
    $task = Task::find($task_id);
    return view('comments.create', compact('task'));
  }

  public function store(Request $request)
  {
    $task = Task::find($request->post_id);
    $comment = new Comment;
    $comment->body  = $request->body;
    $comment->user_id = Auth::id();
    $comment->post_id = $request->post_id;
    $comment->save();

    return redirect('views.show', compact('task'));
  }
}
