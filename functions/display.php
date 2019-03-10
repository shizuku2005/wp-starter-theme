<?php
  // 記事の抜粋の文字の省略を[...]→...（任意の値）に変更する
  function new_excerpt_more( $more ) {
    return '...';
  }
  add_filter( 'excerpt_more', 'new_excerpt_more' );