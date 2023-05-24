<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;




class TaskController extends Controller
{
    //
    public function showTasksPage()
    {
        $tasks = Task::latest()->paginate(8);
        return view("show", ["tasks" => $tasks]);
    }

    public function createTask(Request $request)
    {
        $validator = $request->validate([
            "title" => ["required", "string", "max:30"],
            "contents" => ["required", "string", "max:140"],
        ]);
        Task::create([
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "contents" => $request->contents,
            "image_at" => $request->image_at,
        ]);

        return redirect()->route("show");
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route("show");
    }
}
