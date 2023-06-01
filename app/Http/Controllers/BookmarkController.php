<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookmarkController extends Controller
{
    // ブックマークする
    public function store($task_id)
    {
    $bookmark = new Bookmark();
    $bookmark->task_id = $task_id;
    $bookmark->user_id = Auth::user()->id;
    $bookmark->save();

    return redirect()->back();
    }


    // ブックマーク削除
    public function destroy($bookmark_id)
    {
        $bookmark = Bookmark::find($bookmark_id);
        $bookmark->delete();

        return redirect()->back();
    }

public function indexBookmark($id)
    {
        // $bookmarks = Bookmark::where('user_id', $id)->latest('created_at')->paginate(8);
        // $tasks = collect();
        // foreach($bookmarks as $bookmark) {
        //     $task = Task::find($bookmark->task_id);
        //     $tasks->push($task);
        // }
        // // latest()->paginate(8);
        // return view("bookmark", compact("tasks"));
        // $bookmarks = Bookmark::where('user_id', $id)->latest('created_at')->paginate(8);
        $bookmarks = Bookmark::where('user_id', $id)->latest('created_at');
        $taskIds = $bookmarks->pluck('task_id'); // ブックマークされたタスクのIDを取得
        $tasks = Task::whereIn('id', $taskIds)->paginate(8); // ページネーションをサポートするタスクのリストを取得（1ページあたり8件）

        foreach ($tasks as $task) {
            $task['user_ids'] = json_decode($task->user_ids, true);
        }
    
        return view("bookmark", compact("tasks"));
    }

    // 期限順並び替え
    public function deadline($id)
    {
        // $bookmarks = Bookmark::where('user_id', $id)->latest('created_at')->paginate(8);
        $bookmarks = Bookmark::where('user_id', $id)->latest('created_at');
        $taskIds = $bookmarks->pluck('task_id'); // ブックマークされたタスクのIDを取得 
        $tasks = Task::whereIn('id', $taskIds)->orderBy('date', 'asc')->paginate(8);
        foreach ($tasks as $task) {
            $task['user_ids'] = json_decode($task->user_ids, true);
        }

        return view("bookmark", compact("tasks"));
    }

    // 優先度順並び替え
    public function priorityOder($id)
    {
        // $bookmarks = Bookmark::where('user_id', $id)->latest('created_at')->paginate(8);
        $bookmarks = Bookmark::where('user_id', $id)->latest('created_at');
        $taskIds = $bookmarks->pluck('task_id'); // ブックマークされたタスクのIDを取得 
        $tasks = Task::whereIn('id', $taskIds)->orderBy('priority', 'asc')->paginate(8);
        foreach ($tasks as $task) {
            $task['user_ids'] = json_decode($task->user_ids, true);
        }

        return view("bookmark", compact("tasks"));
    }
}