<?php get_header(); ?>

<div class="wrapper">
  <main>
    <!--
    お知らせ（information）のカスタム投稿があった場合の呼び出し  
    <?php
      $args = array(
        'post_type' => 'information', // カスタム投稿名
        'posts_per_page' => 3, // 表示する数
      );
      $my_query = new WP_Query( $args );
    ?>
    <section>
      <h2>お知らせ</h2>
      <ul class="informationslist">
        <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'Y/m/d' ); ?></time>
              <p><?php the_title(); ?></p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    </section> -->

    <section>
      <h2>最近の投稿</h2>
      <ul class="postslist">
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <li id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
            <a href="<?php the_permalink(); ?>">
              <h2><?php the_title(); ?></h2>
              <?php if(has_category() ): ?>
                <ul class="categorieslist">
                  <?php
                    $category = get_the_category();
                    $i = 0;
                    foreach ($category as $cat) {
                      $i++;
                      echo '<li class="'.esc_html($cat->slug).'">'.esc_html($cat -> cat_name).'</li>';
                    }
                  ?>
                </ul>
              <?php endif; ?>
              <p class="excerpt"><?php the_excerpt(); ?></p>
            </a>
          </li>
        <?php endwhile; endif; ?>
      </ul>
    </section>

  </main>

  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>