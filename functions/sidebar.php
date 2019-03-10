<?php
  // 新規ウィジェットエリアを追加
  register_sidebar(array(
    'name' => 'widget' ,
    'id' => 'widget' ,
    'description' => 'ウィジェット',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));