<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
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
}