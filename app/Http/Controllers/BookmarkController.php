<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookmarkController extends Controller
{
    public function store(Request $request)
    {
    $bookmark = new Bookmark();
    $bookmark->task_id = $request->task_id;
    $bookmark->user_id = Auth::user()->id;
    $bookmark->save();

    return redirect('/tasks');
    }


    public function destroy($id)
    {
        $bookmark = Bookmark::find($id);
        $bookmark->delete();

        return redirect('/tasks');
    
    }

public function indexBookmark($id)
    {
        $bookmarks = Bookmark::where('user_id', $id)->get();
        $tasks = collect();
        foreach($bookmarks as $bookmark) {
            $task = Task::find($bookmark->task_id);
            $tasks->push($task);
        }
        // latest()->paginate(8);
        return view("bookmark", compact("tasks"));
    }
}