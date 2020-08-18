<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body>
    <header class="encabezado-sitio">
      <div class="contenedor">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logotipo.svg" class="logotipo">
        </a>
        </div>
        <div class="informacion-encabezado">
          <div class="redes-sociales">
            <?php $args = array(
                'theme_location' => 'social-menu',
                'container' => 'nav',
                'container_class' => 'sociales',
                'container_id' => 'sociales',
                'link_before' => '<span class="sr-text">',
                'link_after' => '</span>'
            );
            wp_nav_menu($args);
             ?>
          </div> <!-- redes sociales-->

          <div class="direccion">
            <p>Teléfono: <?php echo esc_html( get_option( 'ortopedia_telefono' ) );?></p>
            <p>Dirección: <?php echo esc_html( get_option( 'ortopedia_direccion' ) );?></p>
          </div><!-- direccion-->

        </div>
      </div>
    </header>
    <div class="menu-principal">

      <div class="mobile-menu">
        <a href="#" class="mobile"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
      </div>

      <div class="contenedor navegacion">
        <?php
          $args = array(
              'theme_location' => 'header-menu',
              'container' => 'nav',
              'container_class' => 'menu-sitio'
          );

          wp_nav_menu($args);
        ?>
      </div>
    </div>