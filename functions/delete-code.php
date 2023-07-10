<?php
  // jQueryの読み込みを解除する。ただし、プラグインなどによっては書かないほうがいいかもしれません。
  function my_delete_local_jquery() {wp_deregister_script('jquery');}
  add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

  // バージョン情報の非表示
  remove_action('wp_head', 'wp_generator');
  // Windows Live Writerからの投稿機能を削除
  remove_action('wp_head', 'wlwmanifest_link');
  // ブログ編集ツールから記事を投稿する機能を削除
  remove_action('wp_head', 'rsd_link');