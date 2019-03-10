<?php get_header(); ?>

<div class="wrapper">
  <main>
    <section>
      <?php if(have_posts()): while(have_posts()):the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <p class="excerpt"><?php the_excerpt(); ?></p>
      <?php endwhile; endif; ?>
    </section>
  </main>

  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>