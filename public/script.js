jQuery(function ($) {
  $('.js-accordion-title').on('click', function () {

    // クリックでコンテンツを開閉
    // $(this).next().slideToggle(200);

    $(this).children('menu').slideToggle(200);
    //$thisは、clickした要素である.js-accordion-title。next()は兄弟要素で次に当たる要素。
    //slideToggle(200)は消えているなら表示し、表示されているなら消すという動作を指定。
    //つまり、「.js-accordion-titleの次の兄弟要素を消したり表示したりする」

    // 矢印の向きを変更
    $(this).toggleClass('open', 200);

  }).next().hide();
});
