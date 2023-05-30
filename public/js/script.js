// $('.detail-btn').on('click', function () {
//     $('.box').toggleClass('close');
// });

// $(document).ready(function() {
//     // クリックイベントの例として、特定の要素をクリックした場合に兄弟要素を取得するコードを記述します
//     $('.detail-btn').on('click', function () {
//       // 兄弟要素を取得して処理を行います
//       var siblings = $(this).siblings();
      
//       // 兄弟要素に対して処理を行います
//       siblings.toggleClass('close'); // 兄弟要素の文字色を赤色に設定する例
      
//       // 兄弟要素の取得結果をコンソールに出力して確認することもできます
//     //   console.log(siblings);
//     });
//   });

//アコーディオンをクリックした時の動作
$('.detail-btn').on('click', function() {//タイトル要素をクリックしたら
    $('.box').slideUp(500);//クラス名.boxがついたすべてのアコーディオンを閉じる
      
    var findElm = $(this).next(".box");//タイトル直後のアコーディオンを行うエリアを取得
      
    if($(this).hasClass('close')){//タイトル要素にクラス名closeがあれば
      $(this).removeClass('close');//クラス名を除去    
    }else{//それ以外は
      $('.close').removeClass('close'); //クラス名closeを全て除去した後
      $(this).addClass('close');//クリックしたタイトルにクラス名closeを付与し
      $(findElm).slideDown(500);//アコーディオンを開く
    }
  });
  
  //ページが読み込まれた際にopenクラスをつけ、openがついていたら開く動作※不必要なら下記全て削除
  $(window).on('load', function(){
    $('.accordion-area li:first-of-type section').addClass("open"); //accordion-areaのはじめのliにあるsectionにopenクラスを追加
    $(".open").each(function(index, element){ //openクラスを取得
      var Title =$(element).children('.title'); //openクラスの子要素のtitleクラスを取得
      $(Title).addClass('close');       ///タイトルにクラス名closeを付与し
      var Box =$(element).children('.box'); //openクラスの子要素boxクラスを取得
      $(Box).slideDown(500);          //アコーディオンを開く
    });
  });