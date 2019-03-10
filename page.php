<!-- 固定ページ -->
<?php get_header(); ?>

<div class="wrapper">
  <?php if(have_posts()): the_post(); ?>
  <main class="<?php echo esc_html($post->post_name); ?>">

    <?php echo esc_url(get_the_post_thumbnail( $post->ID, 'header-image' )); ?>

    <section class="section">
      <!--タイトル-->
      <h1><?php the_title(); ?></h1>
      
      <!--本文取得-->
      <?php the_content(); ?>
    </section>
  </main>
  <?php endif; ?>

  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>