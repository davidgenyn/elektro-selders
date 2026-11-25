<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="es-header">
  <div class="es-header__inner">
    <a class="es-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/logo.png' ); ?>" alt="" width="178" height="304">
      <span><?php echo esc_html( es_info( 'naam' ) ); ?></span>
    </a>
    <button class="es-nav__toggle" aria-label="Menu" onclick="document.getElementById('es-nav').classList.toggle('is-open')">&#9776;</button>
    <nav class="es-nav" id="es-nav">
      <?php
      if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) );
      } else {
        es_fallback_menu();
      }
      ?>
    </nav>
  </div>
</header>
<main>
