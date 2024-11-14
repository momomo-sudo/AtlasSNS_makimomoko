// $(function () { // if document is ready
//   alert('hello world')
// });

jQuery(function ($) {
  // スムーズスクロール
  $(function () {
    $('a[href^="#"]').on('click', function () {
      const speed = 400;
      const href = $(this).attr('href');
      const target = $(href === '#' || href === '' ? 'html' : href);
      const position = target.offset().top;
      $('body,html').animate({ scrollTop: position }, speed, 'swing');
      return false;
    });
  });

  // アコーディオン
  $(function () {
    $('#menu_btn').on('click', function () {
      $(this).next().slideToggle();
      // タイトルにopenクラスを付け外しして矢印の向きを変更
      $(this).toggleClass("open", 300);
    });
  });


});

// モーダル機能（編集機能）
$(function () {
  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {

    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数へ格納
    var post = $(this).attr('post');
    // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
    var post_id = $(this).attr('post_id');

    // 取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post').text(post);
    // 取得した投稿のidをモーダルの中身へ渡す
    $('.modal_id').val(post_id);

    // フォームのaction属性を動的に設定
    $('form').attr('action', '/posts/' + post_id);
    return false;
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});
