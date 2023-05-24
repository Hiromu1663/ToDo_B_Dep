<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;




class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::latest()->paginate(8);
        return view("show", compact("tasks"));
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

    function edit($id)
    {
        // dd($id);
        $task = Task::find($id);
        
        return view("edit", compact("task"));
    }
//ここまでとりあえず完成

    function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task -> title = $request -> title;
        $task -> contents = $request -> contents;
        $task -> image_at = $request -> image_at;
        $task -> save();
        return view("show", compact("task"));
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route("show");
    }
}
