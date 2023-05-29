<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスクの登録</title>
  <link rel="stylesheet" href="{{ asset("css/create.css") }}">
</head>
@extends('layouts.app_original')
@section('content')
  <main>
    <div class="add-task">
      <h1 class="task-ttl">タスクの登録</h1>
      <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="task-table">
          <tr>
            <th class="task-item">タイトル</th>
            <td class="task-body">
              <input type="text" class="form-text" name="title">
            </td>
          </tr>
          <tr>
            <th class="task-item">日付</th>
            <td class="task-body">
              <input type="date" class="form-text" min="2023-05-22" max="2025-12-31" name="date">
            </td>
          </tr>
          <tr>
            <th class="task-item">詳細</th>
            <td class="task-body">
              <textarea class="form-textarea" name="contents"></textarea>
            </td>
          </tr>
          <tr>
            <th class="task-item">資料</th>
            <td class="task-body">
              <input id="image_at" type="file" class="@error('image_at') is-invalid @enderror" name="image_at">
                
                                @error('image_at')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
                                @enderror
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
        <button type="submit" href="" class="submit-btn">{{ __('登録') }}</button>
      </form>
    </div>
  </main>
@endsection
