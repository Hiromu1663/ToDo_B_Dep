<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Creatio</title>
  <link rel="stylesheet" href="{{ asset("css/create.css") }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">


</head>
@extends('layouts.app_original')
@section('content')
  <main>
    <div class="add-task">
      <h1 class="task-ttl">Create ToDo</h1>
      <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="task-table">
          <tr>
            <th class="task-item">Title</th>
            <td class="task-body">
              <input type="text" class="form-text" name="title">
            </td>
          </tr>
          <tr>
            <th class="task-item">Date</th>
            <td class="task-body">
              <input type="date" class="form-text" name="date">
            </td>            
          </tr>
          <tr>
            <th class="task-item">Detail</th>
            <td class="task-body">
              <textarea class="form-textarea" name="contents"></textarea>
            </td>
          </tr>
          <tr>
            <th class="task-item">Document</th>
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
            <th class="task-item">Share</th>
            <td class="task-body">
              @foreach ($users as $user)
              <input type="checkbox" name="user_ids[]" value="{{ $user->avatar }}">{{ $user->name }}
              @endforeach
            </td>
          </tr>
          <tr>
          <th class="task-item">Priority</th>
          <td class="task-body">
            <input type="radio" name="priority" value="C">Low
            <input type="radio" name="priority" value="B">Middle
            <input type="radio" name="priority" value="A">Hight
          </td>
        </tr>
        </table>
        <button type="submit" href="" class="submit-btn">{{ __('Submit') }}</button>
      </form>
    </div>
  </main>
@endsection
