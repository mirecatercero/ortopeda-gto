<?php

$taxonomy_obj = $wp_query->get_queried_object();
$taxonomy_nice_name = $taxonomy_obj->name;

get_header(); ?>
<main id="main" class="site-main" role="main">

    <section class="portfolio-archive">

        <h2 class="section-title"><?php echo $taxonomy_nice_name; ?></h2>

        <nav class="portfolio-archive-taxonomies">
            <ul>
                <li class="cat-item cat-item-all"><a href="<?php echo get_page_link( option::get( 'portfolio_url' ) ); ?>"><?php _e( 'All', 'wpzoom' ); ?></a></li>

                <?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => true,  'taxonomy' => 'portfolio', 'depth' => 1 ) ); ?>
            </ul>
        </nav>

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

    </section><!-- .recent-posts -->

</main><!-- .site-main -->

<?php
get_footer();
