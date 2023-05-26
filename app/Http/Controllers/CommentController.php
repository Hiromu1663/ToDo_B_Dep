<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function create($task_id)
  {
    $task = Task::find($task_id);
    return view('comment.create', compact('task'));
  }

  public function store(Request $request)
  {
    // dd($request);
    $task = Task::find($request->task_id);
    // dd($task);
    $comments = new Comment;
    $comments->body  = $request->comment;
    $comments->user_id = Auth::id();
    $comments->task_id = $request->task_id;
    $comments->save();

    return redirect()->route("tasks.index");
  }
}
