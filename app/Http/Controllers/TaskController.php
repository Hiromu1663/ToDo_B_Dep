<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Bookmark;
use App\Models\Comment;


class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::latest()->paginate(8);
        return view("index", compact("tasks"));
    }

    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            "title" => ["required", "string", "max:30"],
            "contents" => ["required", "string", "max:140"],
        ]);

        Task::create([
            // "id" => $request->id,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "contents" => $request->contents,
            "image_at" => $request->image_at,
            "date" => $request->date,
        ]);

        return redirect()->route("tasks.index");
    }

    public function create()
    {
        return view('create');
    }

    function edit($id)
    {
        // dd($id);
        $task = Task::find($id);
        return view("edit", compact("task"));
    }
//ここまでとりあえず完成

    function update(Request $request, $id)
    {
        // dd($id);
        // dd($request);
        $task = Task::find($id);
        // dd($task);
        $task -> title = $request -> title;
        $task -> contents = $request -> contents;
        $task -> image_at = $request -> image_at;
        $task -> save();
        // return view("index", compact("tasks"));
        return redirect()->route("tasks.index");
    }

    public function destroy($id)
    {

        $bookmarks = Bookmark::where("task_id",$id)->delete();
        $comments = Comment::where("task_id",$id)->delete();
        $task = Task::find($id);
        $task->delete();
        return redirect()->route("tasks.index");
    }

    
}
