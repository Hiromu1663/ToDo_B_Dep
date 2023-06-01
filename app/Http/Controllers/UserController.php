<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class UserController extends Controller
{
  public function showProfile($id)
  {
      $user = User::find($id);

      $tasks = Task::where('user_id', $id)->latest()->paginate(8);

      foreach ($tasks as $task) {
        $task['user_ids'] = json_decode($task->user_ids, true);
    }
      
      return view('profile', ['user'=>$user],['tasks'=>$tasks]);
      
  }

  //ドロップダウンメニュー「トップページ」遷移機能用
  public function welcome($id)
  {
      $user = User::find($id);
      
      return view('welcome', ['user'=>$user]);
      
  }
}
