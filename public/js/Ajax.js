$(document).ready(function() {

  // ページ遷移をせずにブックマークつけ外し
  $('.bookmark a').click(function(event) {
    event.preventDefault(); // デフォルトのリンククリックをキャンセル

    let bookmarkLink = $(this); // クリックされたリンク要素を取得
    let bookmarkUrl = bookmarkLink.attr('href'); // リンク先URLを取得
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    // ブックマークがすでについているかどうかを判定
    let isBookmarked = bookmarkLink.has('i.fas.fa-bookmark').length > 0;

    // Ajaxリクエストの送信
    $.ajax({
      url: bookmarkUrl, // ブックマークをつけ外しするURL
      // type: isBookmarked ? 'DELETE' : 'POST', 
      type: 'GET',
      data: {_token: csrfToken}, // CSRFトークンの送信
      success: function(response) {
        console.log(response);
        // レスポンスが成功した場合の処理
        if (response.bookmarked) {
          $('.bookmark a').html('<i class="fas fa-bookmark"></i>'); // ブックマークがついている場合の表示を更新
          location.reload();
        } else {
          $('.bookmark a').html('<i class="far fa-bookmark"></i>'); // ブックマークがついていない場合の表示を更新
          location.reload();
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
    console.log(response);
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

