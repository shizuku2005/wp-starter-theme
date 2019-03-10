<?php
  // 「記事」の自動整形を無効化（pタグなどを消す）
  remove_filter('the_content', 'wpautop');
  // 「抜粋」の自動整形を無効化（pタグなどを消す）
  remove_filter('the_excerpt', 'wpautop');
  // 投稿機能画面でアイキャッチ画像の有効化
  add_theme_support( 'post-thumbnails' );

  // カスタム投稿タイプの追加
  add_action('init', 'registerCustomContribution');
  function registerCustomContribution() {
    // nameは管理画面に表示されるラベル。singular_nameはこの投稿タイプの識別子
    $labels = array('name'=>'お知らせ', 'singular_name'=>'information');
    $args = array(
      'labels' => $labels,
      // フロントに表示させるか
      'public' => true,
      // 検索機能で検索させるかどうか。trueで含めない。
      'exclude_from_search' => true,
      // 生成する個別ページのURLフォーマット（投稿タイプ名=記事のスラッグ）
      'query_var' => true,
      // ページごとにパーマリンクを設定したとき、有効にするか
      'rewrite'   => true,
      // 投稿タイプの閲覧・編集・削除の権限制御に使用する。
      'capability_type' => 'post',
      // この投稿タイプが階層かどうか。
      'hierarchical'    => false,
      // 投稿タイプが表示されるメニューの位置。
      'menu_position'   => 21,
      // このカスタム投稿で使う（表示させる項目）
      'supports' => array('title','editor','thumbnail','revisions'),
      // アーカイブページを生成
      'has_archive' => true,
    );
    register_post_type('information',$args);

    
    // カスタムタクソノミーを作成

    //カテゴリータイプ
    $args = array(
      'label' => 'お知らせカテゴリー',
      'public' => true,
      'show_ui' => true,
      'hierarchical' => true
    );
    register_taxonomy('infomation_category','information',$args);

    //タグタイプ
    $args = array(
      'label' => 'お知らせタグ',
      'public' => true,
      'show_ui' => true,
      'hierarchical' => false
    );
    register_taxonomy('infomation_tag','information',$args);
  }

  //カスタム投稿画面にターム名を表示
  function add_custom_column( $defaults ) {
    $defaults['infomation_category'] = 'カテゴリー';
    return $defaults;
  }
  add_filter('manage_posts_columns', 'add_custom_column');
  function add_custom_column_id($column_name, $id) {
    if( $column_name == 'infomation_category' ) {
      echo get_the_term_list($id, 'infomation_category', '', ', ');
    }
  }
  add_action('manage_posts_custom_column', 'add_custom_column_id', 10, 2);