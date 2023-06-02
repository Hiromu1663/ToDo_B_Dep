$(document).ready(function() {

  // ページ遷移をせずにブックマークつけ外し
  $('.bookmark a').click(function(event) {
    event.preventDefault(); 

    let bookmarkLink = $(this); 
    let bookmarkUrl = bookmarkLink.attr('href'); 
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    let isBookmarked = bookmarkLink.has('i.fas.fa-bookmark').length > 0;
    let targetBookmark = bookmarkLink.closest('.bookmark');

    $.ajax({
      url: bookmarkUrl, 
      type: 'GET',
      data: {_token: csrfToken}, // CSRFトークンの送信
      
      success: function(response) {
        // console.log(response);
          if (isBookmarked) {
            // bookmarkLink.html('<a href="/tasks/{{ $task->id }}/bookmarks"><i class="far fa-bookmark"></i></a>');
            targetBookmark.find('a').html('<i class="far fa-bookmark"></i>'); 
          // location.reload();
        } else {
          // bookmarkLink.html('<a href="/bookmarks/{{ $task->bookmarkedBy(Auth::user())->firstOrfail()->id }}"><i class="fas fa-bookmark"></i></a>');
          targetBookmark.find('a').html('<i class="fas fa-bookmark"></i>');
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
    event.preventDefault(); 
    let deleteForm = $(this).closest('form'); 
    let deleteUrl = deleteForm.attr('action'); 
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

$.ajax({
  url: deleteUrl, 
  type: 'POST',
  data: {_token: csrfToken, _method: 'DELETE'}, 
  beforeSend: function(xhr) {
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); 
  },
  success: function(response) {
    deleteForm.closest('.task-').remove();
    // location.reload();
  },
  error: function(xhr, status, error) {
    console.error(xhr.responseText);
  }
    });
  });
});

