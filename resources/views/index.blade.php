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
 
  <div class="chunks">
  @foreach($tasks->chunk(4) as $chunk)
    <div class="chunk">
      @foreach($chunk as $task)
      <div class="task">
        <div class="title">{{ $task->title }}</div>
        <div class="content">{{ $task->contents }}</div>
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