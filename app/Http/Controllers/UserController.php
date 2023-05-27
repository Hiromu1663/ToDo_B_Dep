<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function showProfile($id)
  {
      $user = User::find($id);
      
      return view('profile', ['user'=>$user]);
      
  }

  //ドロップダウンメニュー「トップページ」遷移機能用
  public function welcome($id)
  {
      $user = User::find($id);
      
      return view('welcome', ['user'=>$user]);
      
  }
}
