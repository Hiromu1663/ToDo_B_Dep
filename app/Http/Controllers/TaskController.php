<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\User;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::latest()->paginate(8);
        return view("index", compact("tasks"));
    }


    // 写真ファイル登録機能追加
    public function store(Request $request)
    {
        // dd($request);
        $image_at = uniqid() . '_' . time() . '.' . $request->file('image_at')->getClientOriginalExtension();

        $request->file('image_at')->storeAs('public/images',$image_at);

        $request->validate([
            "title" => ["required", "string", "max:30"],
            "contents" => ["required", "string", "max:140"],
            "user_ids" => ["required", "array"],
        ]);

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->contents = $request->contents;
        $task->image_at = $image_at;
        $task->date = $request->date;
        $task->user_ids = json_encode($request->user_ids); 
        $task->save();
    
        return redirect()->route("tasks.index");
    }

    // public function store(Request $request)
    // {
    //     dd($request);

    //     $request->validate([
    //         "title" => ["required", "string", "max:30"],
    //         "contents" => ["required", "string", "max:140"],
    //     ]);

    //     Task::create([
    //         // "id" => $request->id,
    //         "user_id" => Auth::id(),
    //         "title" => $request->title,
    //         "contents" => $request->contents,
    //         "image_at" => $request->image_at,
    //         "date" => $request->date,
    //     ]);

    //     return redirect()->route("tasks.index");
    // }

    public function create()
    {
        $users = User::all();
        return view('create', compact('users'));
    }

    function edit($id)
    {
        // dd($id);
        $task = Task::find($id);
        return view("edit", compact("task"));
    }
    

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
        // 外部キー制約により、タスク削除前にブックマークとコメントを先に削除する必要あり。
        // ブックマーク削除
        Bookmark::where("task_id",$id)->delete();
        // コメント削除
        Comment::where("task_id",$id)->delete();
        
        // タスク削除
        Task::find($id)->delete();
        return redirect()->route("tasks.index");
    }

    
    // 期限順並び替え
    public function deadline()
    {
        $tasks = Task::orderBy('date')->paginate(8);
        return view("index", compact("tasks"));
    }


    // route("deadline")実行してもdeadline()が実行されずに、なぜかshow()が実行されてしまう。
    public function show()
    {
        $tasks = Task::orderBy('date')->paginate(8);
        return view("index", compact("tasks"));
    }
}
