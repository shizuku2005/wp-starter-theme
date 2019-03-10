<?php
  function menu_setup() {  
    register_nav_menus( array(
      'global' => 'グローバルメニュー',
      'side'   => 'サイドメニュー',
      'footer' => 'フッターメニュー',
    ) );
  }
  add_action( 'after_setup_theme', 'menu_setup' );