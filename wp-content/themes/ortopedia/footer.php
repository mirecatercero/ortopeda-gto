 <footer>
    <?php 
     $args = array(
        'theme_location' => 'header-menu',
        'container' => 'nav',
        'after' => '<span class="separador"> | </span>'
     );
    wp_nav_menu($args);
    
    ?>
    <div class="ubicacion">
      <p>Teléfono: <?php echo esc_html( get_option( 'ortopedia_telefono' ) );?></p>
      <p>Dirección: <?php echo esc_html( get_option( 'ortopedia_direccion' ) );?></p>
    </div>
    <p class="copyright">Todos los derechos reservados <?php echo date('Y');?>.</p>

 </footer>

<?php wp_footer();  ?>
  </body>
</html>
