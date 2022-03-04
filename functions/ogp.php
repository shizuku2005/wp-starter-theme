<?php
  //headにOGPを出力
  function my_meta_ogp() {
    if( is_front_page() || is_home() || is_singular() ){
      global $post;
      
      $templateUrl = get_template_directory_uri();

      // 下記の項目は任意の値を入れる。
      $default_ogp_image = '';
      $favicon_url = '';
      $appletouchicon_url = '';

      // 以下は初期化の為の変数の為、空でOK
      $description = '';
      $ogp_title = '';
      $ogp_description = '';
      $ogp_url = '';
      $ogp_img = '';
      $insert = '';

      //記事＆固定ページ
      if( is_singular() ) {
        setup_postdata($post);
        // カスタムフィールドにdescriptionが定義されていたら呼び出す
        $descriptionValue = get_post_meta($post->ID, 'description', true);
        // なかったら抜粋を呼び出す
        $description = $descriptionValue ? $descriptionValue : mb_substr(get_the_excerpt(), 0, 100);;

        $ogp_title = $post->post_title;
        $ogp_description = $description;
        $ogp_url = get_permalink();
        wp_reset_postdata();

      //トップページ
      } elseif ( is_front_page() || is_home() ) {
        // ダッシュボード → 設定 → キャッチフレーズから取得
        $description = get_bloginfo('description');
        // ダッシュボード → 設定 → サイトのタイトルから取得
        $ogp_title = get_bloginfo('name');
        $ogp_description = $description;
        $ogp_url = home_url();
      }

      //og:type
      $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

      //og:image
      if ( is_singular() && has_post_thumbnail() ) {
        $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $ogp_img = $ps_thumb[0];
      } else if ($default_ogp_image !== '') {
        $ogp_img = $templateUrl.$default_ogp_image;
      }

      //出力するOGPタグ
      if( is_singular() ) {
        $insert .= '<meta name="description" content="' .esc_attr($description). '" />' . "\n";
      }
      $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'">' . "\n";
      $insert .= '<meta property="og:description" content="'.esc_attr($ogp_description).'">' . "\n";
      $insert .= '<meta property="og:type" content="'.$ogp_type.'">' . "\n";
      $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'">' . "\n";
      $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'">' . "\n";
      $insert .= '<meta name="twitter:card" content="summary">' . "\n";
      if ($ogp_img !== '') {
        $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'">' . "\n";
        $insert .= '<meta name="twitter:image:src" content="'.esc_url($ogp_img).'">' . "\n";
      }
      if ($favicon_url !== '') {
        $insert .= '<link rel="icon" href="' .$templateUrl.esc_attr($favicon_url). '" type="image/x-icon">' . "\n";
      }
      if ($appletouchicon_url !== '') {
        $insert .= '<link rel="apple-touch-icon" href="' .$templateUrl.esc_attr($appletouchicon_url). '" sizes="180x180">';
      }

      echo $insert;
    }
  }
  add_action('wp_head','my_meta_ogp');