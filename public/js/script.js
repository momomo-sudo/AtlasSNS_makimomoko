$(function () { // if document is ready
  alert('hello world')
});

jQuery(function ($) {
  $('.js-accordion-title').on('click', function () {

    // $(this)とは、clickした要素である「.js-accordion-title」

    $(this).find('.ul');//js-accordion-title→$(this)の小要素の中から、ulタグ(menu)のみ取得する
    // クリックでコンテンツを開閉

    // $(this).next('menu').slideToggle(200);
    //$thisは、clickした要素である.js-accordion-title。next()は兄弟要素で次に当たる要素。
    //slideToggle(200)は消えているなら表示し、表示されているなら消すという動作を指定。
    //つまり、「.js-accordion-titleの次の兄弟要素を消したり表示したりする」

    // 矢印の向きを変更
    // $(this).toggleClass('open', 200);


  }).next().hide();
});
