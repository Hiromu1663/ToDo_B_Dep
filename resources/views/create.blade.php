<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>addtask</title>
  <link rel="stylesheet" href="{{ asset("css/create.css") }}">
</head>
<body>
  <header></header>
  <main>
    <div class="add-task">
      <h1 class="task-ttl">タスクの登録</h1>
      <form action="">
        <table class="task-table">
          <tr>
            <th class="task-item">タイトル</th>
            <td class="task-body">
              <input type="text" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="task-item">日付</th>
            <td class="task-body">
              <input type="date" class="form-text" min="2023-05-22" max="2025-12-31"/>
            </td>
          </tr>
          <tr>
            <th class="task-item">詳細</th>
            <td class="task-body">
              <textarea class="form-textarea"></textarea>
            </td>
          </tr>
        </table>
        <button type="submit" href="" class="submit-btn">{{ __('登録') }}</button>
      </form>
      @csrf
    </div>



  </main>
</body>

</html>