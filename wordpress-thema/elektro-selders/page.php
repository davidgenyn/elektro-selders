<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <?php if ( ! is_front_page() ) : ?>
    <div class="es-page-title"><h1><?php the_title(); ?></h1></div>
  <?php endif; ?>
  <div class="es-content"><?php the_content(); ?></div>
<?php endwhile; ?>
<?php get_footer(); ?>
