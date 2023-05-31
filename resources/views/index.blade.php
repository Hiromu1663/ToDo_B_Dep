<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <link rel="stylesheet" href="{{ asset("css/index.css") }}">
  {{-- <script src="{{ asset("js/script.js") }}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('.detail-btn').on('click', function() {//タイトル要素をクリックしたら
        $('.box').slideUp(500);//クラス名.boxがついたすべてのアコーディオンを閉じる
          
        var findElm = $(this).next(".box");//タイトル直後のアコーディオンを行うエリアを取得
          
        if($(this).hasClass('close')){//タイトル要素にクラス名closeがあれば
          $(this).removeClass('close');//クラス名を除去    
        }else{//それ以外は
          $('.close').removeClass('close'); //クラス名closeを全て除去した後
          $(this).addClass('close');//クリックしたタイトルにクラス名closeを付与し
          $(findElm).slideDown(500);//アコーディオンを開く
        }
      });
    });
    </script>
  <title>タスク一覧</title>
</head>
@extends('layouts.app_original')
@section('content')
  {{-- <div class="function">
    <a href="{{ route('deadline') }}"><p>todoリスト期限順に並び替え</p></a>
  </div> --}}
  <!-- Todoリスト並び替え -->
  <div class="f-row">
    <div class="function">
      <label for="menu">並び替え</label>
      <input type="checkbox" id="menu">
      <ul class="dropdown">
        <a href="{{ route('tasks.index') }}"><li>登録順</li></a>
        <a href="{{ route('deadline') }}"><li>期限順</li></a>
        <li>重要度順</li>
      </ul>
    </div>
    <div>
      <a href="{{ route('tasks.create') }}">＋</a>
    </div>
  </div>
  
  <div class="chunks">
  @foreach($tasks->chunk(4) as $chunk)
    <div class="chunk">
      @foreach($chunk as $task)
      <div class="task">
        @if($task->image_at !== null)
        <div class="image_at">
          <img src="{{ asset('storage/images/'.$task->image_at) }}" alt="">
        </div>
        @endif
        <div class="title">{{ $task->title }}</div>
        <div class="content">{{ $task->contents }}</div>

          <div class="detail-btn">詳細</div>
          <div class="box">
            <div class="date">投稿日：{{ $task->created_at->format('Y-m-d') }}</div>
            <div class="limit">
              @php
                  $now = \Carbon\Carbon::now();
                  $dueDate = \Carbon\Carbon::parse($task->date);
                  $daysRemaining = $dueDate->diffInDays($now);
              @endphp

              @if ($daysRemaining <= 3)
                <span class="limit-text">期限：あと{{ $daysRemaining }}日</span>
              @else
                期限：あと{{ $daysRemaining }}日
              @endif
            </div>
            <div class="priority">{{ $task->priority }}</div>
            <div class="btn-container">
                {{-- 編集機能追加 --}}
                @if($task->user_id == Auth::user()->id)
                <form action="{{ route('tasks.edit', [$task->id]) }}" method="POST">
                  @csrf
                  @method('get')
                  <input type="submit" value="編集">
                </form>
                {{-- 削除機能追加 --}}
                <form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST">
                  @csrf
                  @method('delete')
                <input type="submit" value="削除">
                </form>
                @endif
            </div>

            {{-- コメント機能 --}}
            <div>
              <a href="{{ route('comments.create',$task->id) }}">コメントする</a>
            </div>
            {{-- <div class="row justify-content-center"> --}}
            <div>
              <div class="">
                コメント一覧
                @foreach ($task->comments as $comment)
                  <div class="card mt-3">
                      {{-- <h5 class="card-header">投稿者：{{ $comment->user->name }}</h5> --}}
                      <div class="card-body">
                          {{-- <h5 class="card-title">投稿日時：{{ $comment->created_at }}</h5> --}}
                          <p class="card-text">内容：{{ $comment->body }}</p>
                          @if($comment->user_id == Auth::user()->id)
                          <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                          <input type="submit" value="削除">
                          </form>
                        @endif
                      </div>
                  </div>            
                @endforeach
              </div>
            </div>
          </div>
          <div class="bookmark">
            @if($task->bookmarkedBy(Auth::user())->exists())
            <a href="/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}">ブックマークを外す</a>
            @else
            <a href="/tasks/{{ $task->id }}/bookmarks">ブックマーク</a> 
            @endif
          </div>
        {{-- </div> --}}
      </div>
      @endforeach
    </div>
  @endforeach
  </div>
  {{ $tasks->links() }}
  @endsection
