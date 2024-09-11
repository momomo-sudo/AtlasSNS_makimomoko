$(function () { // if document is ready
  alert('hello world')
});

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
    });
  });

});
