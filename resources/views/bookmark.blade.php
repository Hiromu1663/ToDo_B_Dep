<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <link rel="stylesheet" href="{{ asset("css/index.css") }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
  {{-- <script src="{{ asset("js/app.js") }}"></script> --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> 
   {{-- <script src="{{ asset("js/script.js") }}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/Ajax.js') }}"></script>
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
  <title>Bookmarks</title>
</head>
@extends('layouts.app_original')
@section('content')
<div class="background">
  <div class="top-title">
   <h1>Bookmarks</h1>
  </div>
<div class="f-row">
  <div class="function">
    <label for="menu">Sort by</label>
    <input type="checkbox" id="menu">
    <ul class="dropdown">
      <a href="/indexBookmark/{{ Auth::user()->id }}"><li>Submit</li></a>
      <a href="/bookmarkdeadline/{{ Auth::user()->id }}"><li>Deadline</li></a>
      <a href="/bookmarkpriorityOder/{{ Auth::user()->id }}"><li>Priority</li></a>
    </ul>
  </div>

  <div>
    <a class="add-button" href="{{ route('tasks.create') }}"><i class="far fa-plus-square"></i></a>
  </div>
</div>
</div>
<div class="chunks">
  @foreach($tasks->chunk(4) as $chunk)
  <div class="chunk">
    @foreach($chunk as $task)
    <div class="task-">
      {{-- 共同製作者 --}}
      <div class="co-producer">
        @foreach($task->user_ids as $user_id)
          <img src="{{ asset('storage/images/'.$user_id) }}" alt="">
        @endforeach
      </div>

      <div class="task">
        @if($task->image_at !== null)
        <div class="image_at">
          <img src="{{ asset('storage/images/'.$task->image_at) }}" alt="">
        </div>
        @endif
        <div class="title">{{ $task->title }}</div>
        <div class="content">{{ $task->contents }}</div>
        <div class="detail-btn">Detail</div>
        <div class="box">
          <div class="date">Created：{{ $task->created_at->format('Y-m-d') }}</div>
          <div class="limit">
            @php
              $now = \Carbon\Carbon::now();
              $dueDate = \Carbon\Carbon::parse($task->date);
              $daysRemaining = $dueDate->diffInDays($now);
            @endphp

            @if ($daysRemaining <= 3)
              <span class="limit-text">Deadline：{{ $daysRemaining }}day left</span>
            @else
              Deadline：{{ $daysRemaining }} day left
            @endif
          </div>
          {{-- 優先度表示 --}}
          <div class="priority">
            @switch($task->priority)
              @case('A')
                優先度高
                @break
              @case('B')
                優先度中
                @break
              @case('C')
                優先度低
                @break
              @default
                不明
            @endswitch
          </div>
            {{-- 共同製作者のみ編集ボタン、削除ボタン表示 --}}
          @if ($task->user_ids)
            @php
              $match = false;
              for ($i = 0; $i < count($task->user_ids); $i++) {
                if ($task->user_ids[$i] == Auth::user()->avatar) {
                  $match = true;
                  break;
                }
              }
            @endphp
            @if ($match)
              <!-- 一致した場合の処理 -->
          <div class="btn-container">
            {{-- 編集機能追加 --}}
            <form action="{{ route('tasks.edit', [$task->id]) }}" method="GET">
              @csrf

              @method('get')
              <input type="submit" value="Edit">

            </form>
              {{-- 削除機能追加 --}}
            <form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST">
              @csrf
              @method('delete')

              <input type="submit" value="Delet">

            </form>
          </div>  
            @endif
          @endif

          {{-- コメント機能 --}}
          <div class="t">
            <a href="{{ route('comments.create',$task->id) }}"><i class="far fa-comment-dots"></i></a>
          </div>
          {{-- <div class="row justify-content-center"> --}}
          <div>
            <div class="">
              ▼ Comments ▼
              @foreach ($task->comments as $comment)
              <div class="card mt-3">
                {{-- <h5 class="card-header">投稿者：{{ $comment->user->name }}</h5> --}}
                <div class="card-body">
                  {{-- <h5 class="card-title">投稿日時：{{ $comment->created_at }}</h5> --}}
                  <p class="card-text">Content：{{ $comment->body }}</p>
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
          <a href="/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}"><i class="fas fa-bookmark"></i></a>
          @else
          <a href="/tasks/{{ $task->id }}/bookmarks"><i class="far fa-bookmark"></i></a> 
          @endif
        </div>
      </div>
    </div>
      @endforeach
  </div>
    @endforeach
</div>
@endsection
{{ $tasks->links() }}
</html>



