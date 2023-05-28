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

    return redirect('/tasks');
    }


    // ブックマーク削除
    public function destroy($bookmark_id)
    {
        $bookmark = Bookmark::find($bookmark_id);
        $bookmark->delete();

        return redirect('/tasks');
    
    }

public function indexBookmark($id)
    {
        $bookmarks = Bookmark::where('user_id', $id)->latest('created_at')->paginate(8);
        $tasks = collect();
        foreach($bookmarks as $bookmark) {
            $task = Task::find($bookmark->task_id);
            $tasks->push($task);
        }
        // latest()->paginate(8);
        return view("bookmark", compact("tasks"));
    }
}