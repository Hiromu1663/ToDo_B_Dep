<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/edit.css") }}">
    <title>編集</title>
</head>
@extends('layouts.app_original')
@section('content')
{{-- <header>
    <div>
        <ul>
            <li><a href="#">編集する</a></li>
        </ul>
    </div>
</header> --}}
<main>
    <div class="add-task">
        <h1 class="task-ttl">タスクの編集</h1>
        <form action="{{ route('tasks.update',$task->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="task-table">
                <tr>
                <th class="task-item">タイトル</th>
                <td class="task-body">
                    <input type="text" class="form-text" value="{{ $task->title }}" name="title">
                </td>
                </tr>
                <tr>
                <th class="task-item">日付</th>
                <td class="task-body">
                    <input type="date" class="form-text" min="2023-05-22" max="2025-12-31" value="{{ $task->date }}" name="date">
                </td>
                </tr>
                <tr>
                <th class="task-item">詳細</th>
                <td class="task-body">
                    <textarea class="form-textarea" name="contents">{{ $task->contents }}</textarea>
                </td>
                </tr>
                <tr>
                <th class="task-item">資料</th>
                <td class="task-body">
                    <input id="image_at" type="file" class="@error('image_at') is-invalid @enderror" value="{{ $task->image_at }}" name="image_at">
                    
                                    @error('image_at')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                </td>
                </tr>
                <tr>
                <th class="task-item">共同製作者</th>
                <td class="task-body">
                    @foreach ($users as $user)
                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">{{ $user->name }}
                    @endforeach
                </td>
                </tr>
                <tr>
                <th class="task-item">優先度</th>
                <td class="task-body">
                <input type="radio" name="priority" value="優先度 低">低
                <input type="radio" name="priority" value="優先度 中">中
                <input type="radio" name="priority" value="優先度 高">高
                </td>
            </tr>
            </table>
            <button type="submit" class="submit-btn-btn">{{ __('編集') }}</button>
        </form>
    </div>
</main>
@endsection
