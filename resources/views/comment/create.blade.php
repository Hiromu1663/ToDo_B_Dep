<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="{{ asset("css/create_comment.css") }}">
  <title>Comment Create</title>
</head>
@extends('layouts.app_original')
@section('content')
<div class="container">
      
  <div class="chunks">
    <div class="chunk">
      <div class="task-">
        <div class="task">
          <div class="image_at">
            <img src="{{ asset('storage/images/'.$task->image_at) }}" alt="">
          </div>
          <div class="title">{{ $task->title }}</div>
          <div class="content">{{ $task->contents }}</div>
          {{-- <div class="created_at">{{ $task->created_at }}</div> --}}
        </div>
      </div>
    </div>
  </div>


  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <div class="form-group">
                <label>Comment</label>
                <textarea class="form-control" 
                placeholder="Content" rows="5" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Comment Create</button>
        </form>
    </div>
  </div>
</div>
@endsection