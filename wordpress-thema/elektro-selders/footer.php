</main>
<footer class="es-footer">
  <div class="es-footer__inner">
    <div>
      <p class="es-footer__title"><?php echo esc_html( es_info( 'naam' ) ); ?></p>
      <p><?php echo esc_html( es_info( 'slogan' ) ); ?></p>
      <p><?php echo esc_html( es_info( 'adres' ) ); ?><br>BTW <?php echo esc_html( es_info( 'btw' ) ); ?></p>
    </div>
    <div>
      <p class="es-footer__title">Contact</p>
      <ul>
        <li><a href="<?php echo esc_attr( es_info( 'tel_link' ) ); ?>"><?php echo esc_html( es_info( 'tel' ) ); ?></a></li>
        <li><a href="mailto:<?php echo esc_attr( es_info( 'email' ) ); ?>"><?php echo esc_html( es_info( 'email' ) ); ?></a></li>
        <li><?php echo esc_html( es_info( 'uren' ) ); ?></li>
      </ul>
    </div>
    <div>
      <p class="es-footer__title">Pagina's</p>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
        <li><a href="<?php echo esc_url( home_url( '/diensten/' ) ); ?>">Diensten</a></li>
        <li><a href="<?php echo esc_url( home_url( '/over-ons/' ) ); ?>">Over ons</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
      </ul>
    </div>
  </div>
  <div class="es-footer__bottom">© <?php echo date( 'Y' ); ?> <?php echo esc_html( es_info( 'naam' ) ); ?> · <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy</a></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
