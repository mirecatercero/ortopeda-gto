<?php
/*
Template Name: Portfolio (Sorting Effect)
*/

get_header(); ?>

<main id="main" <?php post_class( (has_post_thumbnail() ? ' portfolio-with-post-cover' : '') ); ?> role="main">

    <section class="portfolio-archive">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="portfolio-header-cover">
                <?php $entryCoverBackground = get_the_image( array( 'size' => 'entry-cover', 'format' => 'array', 'attachment' => false, 'image_scan' => false ) ); ?>
                <?php if ( isset( $entryCoverBackground['src'] ) ) : ?>

                    <div class="portfolio-header-cover-image" style="background-image: url('<?php echo $entryCoverBackground['src'] ?>');"></div>

                <?php endif; ?>

                <div class="portfolio-header-info">
                    <div class="entry-info">
                        <?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

                        <div class="entry-header-excerpt"><?php the_content(); ?></div>

                    </div>
                </div><!-- .portfolio-header-info -->

            </div><!-- .portfolio-header-cover -->

            <nav class="portfolio-archive-taxonomies">
                <ul class="portfolio-taxonomies portfolio-taxonomies-filter-by">
                    <li class="cat-item cat-item-all current-cat"><a href="<?php echo get_page_link( option::get( 'portfolio_url' ) ); ?>"><?php _e( 'All', 'wpzoom' ); ?></a></li>

                    <?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => true,  'taxonomy' => 'portfolio', 'depth' => 1 ) ); ?>
                </ul>


                <?php echo term_description( ) ?>



            </nav>

        <?php endwhile; // end of the loop. ?>


        <?php
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'      => 'portfolio_item',
            'posts_per_page' => -1,
        );

        $wp_query = new WP_Query( $args );
        ?>

        <?php if ( $wp_query->have_posts() ) : ?>

            <div class="portfolio-grid">

                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <?php get_template_part( 'portfolio/content' ); ?>

                <?php endwhile; ?>

            </div>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .portfolio-archive -->

</main><!-- #main -->

<?php get_footer(); ?>