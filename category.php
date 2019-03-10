<?php get_header(); ?>
<div class="wrapper">
  <main>
    <h1 class="<?php echo esc_html(get_queried_object() -> slug); ?>"><?php single_cat_title(); ?> カテゴリー記事の一覧</h1>
    
    <div class="postslist">
      <ul>
        <?php if(have_posts()): while(have_posts()):the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
            <p class="excerpt"><?php the_excerpt(); ?></p>
          </a>
        </li>
        <?php endwhile; endif; ?>
      </ul>
    </div>
      
    <?php previous_posts_link('新しい投稿ページへ'); ?>
    <?php next_posts_link('古い投稿ページへ'); ?>
  
  </main>

  <?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>​