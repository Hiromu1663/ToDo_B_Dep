<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/profile.css">
  <title>マイページ</title>
</head>
<body>
  <header></header>
  <main>
    <div class="profile">
      <div class="profile-1">
        <img src="" alt="">
      </div>
      <div class="profile-2">
        <p>name</p>
        <p >ID</p>
      </div>
    </div>

    <div class="function">
      <p>todoリスト期限じゅんに並び替え</p>
      <p>ブックマーク</p>
    </div>


  <!-- @foreach($tasks->chunk(3) as $chunk) -->
    <div class="chunk">
      <!-- @foreach($chunks as $task) -->
      <div class="show-tasks">
        <div>{{ $task->title }}</div>
        <div>{{ $task->contents }}</div>
      </div>
      <!-- @endforeach -->
    </div>
    <!-- @endforeach -->
  </main>
  
</body>
</html>