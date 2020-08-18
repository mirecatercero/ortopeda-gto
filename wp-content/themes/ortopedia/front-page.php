<?php get_header(); ?>

  <?php 	while(have_posts()): the_post(); ?>

    <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="contenido-hero">
        <div class="texto-hero">
            <h1><?php bloginfo('name'); ?></h1><br>
            <h4><?php bloginfo('description'); ?></h4>
            <?php $url = get_page_by_title('Nosotros'); ?>

            <a href="<?php echo get_permalink($url->ID); ?>" class="button rojo">Leer más...</a>
        </div>
      </div>
    </div>
    <?php 	endwhile; ?>

      <div class="	principal contenedor">
        <main class="row justify-content-md-center">
          <h1 class="texto-rojo texto-centrado">Algunos artículos que vendemos</h1>

          <?php 
          
          $args = array(
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'post_type' => 'aparatos'
          ); 
          $articulos = new WP_Query($args);
          while($articulos->have_posts()): $articulos->the_post();
          ?>
          <div class="especialidad col-md-4">
            <div class="contenido-articulo">
              <?php the_post_thumbnail('articulos_portrait'); ?>
              <div class="informacion-articulo">
                  <?php the_title('<h3>','</h3>'); ?>
                  <?php the_content(); ?>
                  <p class="precio">$ <?php the_field('precio'); ?></p>
                  <a href="<?php the_permalink(); ?>" class="button rojo">Leer más...</a>
              </div>          
            </div>
          </div>
          
        <?php endwhile; wp_reset_postdata();?>
        </main>
      </div>
      
      <section class="inforto">
            <div class="contenedor">
                <div class="row transparencia">

                  <?php while(have_posts()): the_post();  ?>

                    <div class="col-md-6">
                      <?php the_field('contenido'); ?>
                      <?php $url = get_page_by_title('Sobre Nosotros'); ?>
                      <a href="<?php echo get_permalink($url->ID); ?>" class="button rojo">Leer más...</a>
                    </div>
                    <div class="col-md-6">
                      <img src="<?php the_field('imagen'); ?>" style="width:100%;">
                    </div>
                    <?php endwhile; ?>
              </div>
            </div>
      </section>

      <section class="contenedor">
          <h2 class="texto rojo">Galería de imágenes</h2>
          <?php $url = get_page_by_title('Galería',TRUE); ?>
          <?php
          
          print_r($url['post_content']);
          //echo get_post_gallery($url->ID, TRUE); NO JALÓ ESTA MAMADA ?>
      </section>

      <section class="ubicacion-reservacion contenedor">
           <div class="row">
                <div class="col-md-8">
                  <div id="map">
                  
                  </div>
                </div>
                <div class="col-md-4">
                <?php get_template_part('templates/formulario','reservacion'); ?>
                </div>
           </div>
      </section>

<?php get_footer(); ?>