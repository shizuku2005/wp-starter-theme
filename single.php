<!-- 投稿ページ -->
<?php get_header(); ?>

<div class="wrapper">
  <main>
    <?php if(have_posts()): the_post(); ?>

    <section class="section" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <h1><?php the_title(); ?></h1>

      <div class="singleinformations">
        <div class="lastupdate">
          最終更新日：<time><?php the_modified_date( 'Y/m/d' ) ?></time>
        </div>

        <div class="categories">
          <p class="categoriesTitle">記事カテゴリー：</p>
          <?php if(has_category() ): ?>

            <ul class="categorieslist">
              <?php
                $category = get_the_category();
                for ($i = 0; $i < count($category); $i++) {
                  $listStrings = '';
                  $listStrings .= '<li class="' . esc_attr($category[$i] -> slug) . '">';
                  $listStrings .= '<a href="' . esc_url(get_category_link( $category[$i] -> cat_ID )) . '">';
                  $listStrings .= esc_html($category[$i] -> cat_name);
                  $listStrings .= '</a></li>';
                  echo $listStrings;
                }
              ?>
            </ul>

          <?php endif; ?>
        </div>

      </div>

      <?php if ( has_post_thumbnail()): ?>
        <div class="thumbnail" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>)"></div>
      <?php endif; ?>
      
      <article>
        <?php the_content(); ?>

        <?php
        $defaults = array(
          'before'           => '<ol class="pager"><li>',
          'after'            => '</li></ol>',
          'separator'        => '</li><li>',
          'nextpagelink'     => '次のページへ',
          'previouspagelink' => '前のページへ',
          'pagelink'         => '%' // %は必須で、数値に置き換わる
        );
        wp_link_pages( $defaults );
        ?>

      <?php endif; ?>

      </article>
    </section>

  </main>

  <?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>