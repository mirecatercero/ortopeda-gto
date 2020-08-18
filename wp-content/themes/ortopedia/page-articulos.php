<?php

 get_header(); ?>

  <?php 	while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="contenido-hero">
        <div class="texto-hero">
            <?php the_title('<h1>', '</h1>'); ?>
        </div>
      </div>
    </div>

      <div class="	principal ">
        <main class="text-centrado contenido-paginas">
          <?php the_content(); ?>
        </main>
      </div>
  <?php 	endwhile; ?>

  <div class="nuestras-especialidades ">
    <h3 class="texto-rojo">Algunos Aparatos</h3>
    <div class="contenedor-grid">
          <?php 
            $args = array(
              'post_type' => 'aparatos',
              'post_per_type' => -1,
              'orderby' => 'title',
              'order' => 'ASC',
              'category_name' => 'aparatos'

            );
            $articulos = new WP_Query($args);
            while($articulos->have_posts()): $articulos->the_post();
          ?>
            <div class="columnas2-4">
                <?php the_post_thumbnail('articulos'); ?>
                  <div class="texto-especialidad">
                      <h4><?php the_title(); ?> <span>$<?php the_field('precio'); ?></span></h4>
                      <?php the_content(); ?>
                  </div>
            </div>

          <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>

<!-- IMPRIMIR OTROS -------------------------------------------------------------------------->


  <div class="nuestras-especialidades ">
    <h3 class="texto-rojo">Otros</h3>
    <div class="contenedor-grid">
          <?php 
            $args = array(
              'post_type' => 'aparatos',
              'post_per_type' => -1,
              'orderby' => 'title',
              'order' => 'ASC',
              'category_name' => 'otros'

            );
            $articulos = new WP_Query($args);
            while($articulos->have_posts()): $articulos->the_post();
          ?>
            <div class="columnas1-3">
                <?php the_post_thumbnail('articulos'); ?>
                  <div class="texto-especialidad">
                      <h4><?php the_title(); ?> <span>$<?php the_field('precio'); ?></span></h4>
                      <?php the_content(); ?>
                  </div>
            </div>

          <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>

<?php get_footer(); ?>