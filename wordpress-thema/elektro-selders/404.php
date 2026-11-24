<?php get_header(); ?>
<div class="es-page-title"><h1><?php echo is_404() ? 'Pagina niet gevonden' : esc_html( get_the_archive_title() ); ?></h1></div>
<div class="es-content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php the_excerpt(); ?>
<?php endwhile; else : ?>
  <p>Deze pagina bestaat niet. <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Terug naar de homepage</a>.</p>
<?php endif; ?>
</div>
<?php get_footer(); ?>
