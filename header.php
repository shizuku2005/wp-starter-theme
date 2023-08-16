<?php
  $ogType = is_front_page() || is_home() ? "website" : "article";
?><!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# <?php echo $ogType; ?>: http://ogp.me/ns/<?php echo $ogType; ?>#">
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php if( is_front_page() || is_home() ): ?>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <?php elseif( is_single() || is_page() ): ?>
    <meta name="description" content="<?php echo strip_tags( get_the_excerpt() ); ?>">
  <?php else: ?>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <?php endif; ?>

  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <?php wp_head(); ?>
  
  <!-- 以下のページの場合、noindexに登録する。-->
  <?php if(is_tag() || is_date() || is_search() || is_404()) : ?>
  <meta name="robots" content="noindex">
  <?php endif; ?>
</head>

<body <?php echo body_class(); ?>>
  <header>
    <div class="logo">
      <a href="<?php echo home_url(); ?>">
        <?php bloginfo( 'name' ); ?>
      </a>
    </div>

    <nav class="globalnavigation">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'global',
          'container'      => '',
          'depth'          => 1,
        ) );
      ?>
    </nav>
  </header>