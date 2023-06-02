$(document).ready(function() {

  // ページ遷移をせずにブックマークつけ外し
  $('.bookmark a').click(function(event) {
    event.preventDefault(); 

    let bookmarkLink = $(this); 
    let bookmarkUrl = bookmarkLink.attr('href'); 
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    let isBookmarked = bookmarkLink.has('i.fas.fa-bookmark').length > 0;
    // let targetBookmark = bookmarkLink.closest('.bookmark');

    $.ajax({
      url: bookmarkUrl, 
      type: 'GET',
      data: {_token: csrfToken}, // CSRFトークンの送信
      
      success: function(response) {
        console.log(response);
          if (isBookmarked) {
            // bookmarkLink.attr('href', '/tasks/{{ $task->id }}/bookmarks');
            // targetBookmark.find('i').removeClass('fas fa-bookmark').addClass('far fa-bookmark');
            bookmarkLink.html('<a href="/tasks/{{ $task->id }}/bookmarks"><i class="far fa-bookmark"></i></a>');
          // location.reload();
        } else {
          // targetBookmark.find('a').html('<i class="fas fa-bookmark"></i>');
          // bookmarkLink.attr('href', '/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}');
          // targetBookmark.find('i').removeClass('far fa-bookmark').addClass('fas fa-bookmark');
          bookmarkLink.html('<a href="/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}"><i class="fas fa-bookmark"></i></a>');
          // location.reload();
        }
        
        
      },
      error: function(xhr, status, error) {
        // レスポンスがエラーの場合の処理
        console.error(xhr.responseText);
      }
    });
  });


  // ページ遷移をせずにタスク削除
  $('.delete-button').click(function(event) {
    event.preventDefault(); // デフォルトのフォーム送信をキャンセル

    let deleteForm = $(this).closest('form'); // クリックされた削除ボタンの親フォーム要素を取得
    let deleteUrl = deleteForm.attr('action'); // フォームのアクション属性から削除URLを取得
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

// Ajaxリクエストの送信
$.ajax({
  url: deleteUrl, // 削除するURL
  type: 'POST',
  data: {_token: csrfToken, _method: 'DELETE'}, // CSRFトークンとメソッドを送信
  beforeSend: function(xhr) {
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // リクエストヘッダーにCSRFトークンを設定
  },
  success: function(response) {
    // console.log(response);
    // レスポンスが成功した場合の処理
    deleteForm.closest('.comment').remove(); // コメントの要素を削除
    location.reload();
  },
  error: function(xhr, status, error) {
    // レスポンスがエラーの場合の処理
    console.error(xhr.responseText);
  }
    });
  });
});

