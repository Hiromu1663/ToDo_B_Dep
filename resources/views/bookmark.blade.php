@extends('layouts.app_original')
@section('header')

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <link rel="stylesheet" href="{{ asset("css/bookmark.css") }}">
  <script src="{{ asset("js/app.js") }}"></script>
  <title>ブックマーク</title>
</head>
<body>
<div class="function">
    <p><a href="{{ route('tasks.index') }}">todo作成順に並び替え</a></p>
  </div>
  <div class="chunks">
  @foreach($tasks->chunk(4) as $chunk)
    <div class="chunk">
      @foreach($chunk as $task)
      <div class="task">
        <div class="title">{{ $task->title }}</div>
        <div class="content">{{ $task->contents }}</div>
        <div>
          <a href="{{ route('tasks.edit',$task->id) }}">編集</a>
        </div>
        @if($task->bookmarkedBy(Auth::user())->exists())
        <a href="/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}">ブックマークを外す</a>
        @else
        <a href="/tasks/{{ $task->id }}/bookmarks">ブックマーク</a> 
        @endif
      </div>
      @endforeach
    </div>
  @endforeach
  {{-- {{ $tasks->links() }} --}}
  </div>
</body>
@endsection