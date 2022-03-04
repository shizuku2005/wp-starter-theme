<?php
  // WordPressコアから出力されるHTMLタグをHTML5のフォーマットにする
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
  // titleタグを自動で出力
  add_theme_support( 'title-tag' );

  // ページタイトルとサイトのタイトルの区切り文字を変更
  function wp_document_title_separator( $separator ) {
    $separator = '|';
    return $separator;
  }
  add_filter( 'document_title_separator', 'wp_document_title_separator' );

  // 固定ページ表示時にbody_class関数にページスラッグを追加する
  add_filter( 'body_class', 'add_page_slug_class_name' );
  function add_page_slug_class_name( $classes ) {
    if ( is_page() ) {
      $page = get_post( get_the_ID() );
      $classes[] = $page->post_name;
    }
    return $classes;
  }

  // タイトルタグを「サイト名」だけにする
  function remove_titletag($title) {
    if (isset($title['tagline'])) {
      unset($title['tagline']);
    }
    return $title;
  }
  add_filter('document_title_parts','remove_titletag');

  // 管理者以外のユーザーがログインしても、管理バーを表示させない
  $current_user = wp_get_current_user();
  if( !($current_user->ID == "1" )) {
    add_filter('show_admin_bar', '__return_false');
  }

  // headで読み込ませるJSをfooterに移動
  function move_scripts(){
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
  }
  add_action( 'wp_enqueue_scripts', 'move_scripts' );

  // Javascriptの読み込み設定
  function twpp_enqueue_scripts() {
    wp_enqueue_script(
      'myscript',
      get_template_directory_uri() . '/script.js',
      array(), // このスクリプトを読み込むべき前に読み込むJS
      false, // バージョン番号を指定するか
      true // trueでフッターでJSを読み込む。
    );
  }
  add_action( 'wp_enqueue_scripts', 'twpp_enqueue_scripts' );

  add_filter('script_loader_tag', 'add_defer', 10, 2);
  function add_defer($tag, $handle) {
    if($handle !== 'myscript') {
      return $tag;
    }

    return str_replace(' src=', ' defer src=', $tag);
  }