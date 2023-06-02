<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset("css/index.css") }}">
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
    <label for="menu" style="font-size: 12px">Sort by</label>
    <input type="checkbox" id="menu" />
    <ul id="dropdown">
      <li><a href="/indexBookmark/{{ Auth::user()->id }}">Created</a></li>
      <li><a href="/bookmarkdeadline/{{ Auth::user()->id }}">Deadline</a></li>
      <li><a href="/bookmarkpriorityOder/{{ Auth::user()->id }}">Priority</a></li>
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
      <div class="task">
        @if($task->image_at !== null)
        <div class="image_at">
          <img src="{{ asset('storage/images/'.$task->image_at) }}" alt="">
        </div>
        @endif
          {{-- 共同製作者 --}}
          <div class="co-producer">
            @foreach($task->user_ids as $user_id)
              <img src="{{ asset('storage/images/'.$user_id) }}" alt="">
            @endforeach
          </div>
        <div class="title">{{ $task->title }}</div>
        <div class="content">{{ $task->contents }}</div>
        <div class="detail-btn">detailes</div>
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
                High
                @break
              @case('B')
                Middle
                @break
              @case('C')
                Low
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
          {{-- <div class="t">
            <a href="{{ route('comments.create',$task->id) }}"><i class="far fa-comment-dots"></i></a>
          </div> --}}
          {{-- <div class="row justify-content-center"> --}}
          <div>

            <div class="">
              ▼ Comments &nbsp; <a href="{{ route('comments.create',$task->id) }}"><i class="far fa-comment-dots"></i></a>
              @foreach ($task->comments as $comment)
              <div class="card mt-3">
                <p class="card-header">投稿者：{{ $comment->user->name }}</p>
                <div class="card-body">
                  <p class="card-title">投稿日時：{{ $comment->created_at->format('Y-m-d') }}</p>
                  <p class="card-text">Content：{{ $comment->body }}</p>
                  @if($comment->user_id == Auth::user()->id)
                  <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delet">
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
          <a href="/bookmarks/{{ $task->id }}"><i class="fas fa-bookmark"></i></a>
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

{{ $tasks->links() }}

</main>
@endsection


