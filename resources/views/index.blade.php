<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <link rel="stylesheet" href="{{ asset("css/show.css") }}">
  <script src="{{ asset("js/app.js") }}"></script>
  <title>タスク一覧</title>
</head>
<body>
  <div class="function">
    <p>todoリスト期限順に並び替え</p>
  </div>
  <div>
    <a href="{{ route('tasks.create') }}">タスクの追加</a>
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
        <div> 
          {{-- 削除機能追加 --}}
            @if($task->user_id == Auth::user()->id)
              <form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST">
                @csrf
                @method('delete')
              <input type="submit" value="削除">
              </form>
            @endif
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
  {{ $tasks->links() }}
  </div>

  {{-- <div class="chunks">
    <div class="chunk">
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
    </div>

    <div class="chunk">
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
      <div class="task">
        <div class="title">title</div>
        <div class="content">content</div>
      </div>
    </div>
  </div> --}}
</body>
</html>