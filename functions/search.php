<?php
  // アクションフックを使って、検索結果から固定ページを除く
  function my_main_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
      if ( $query->is_search ) {
        $query->set( 'post_type', 'post' ) ;
      }
    }
  }
  add_action ('pre_get_posts', 'my_main_query' );