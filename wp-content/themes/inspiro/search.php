<?php get_header(); ?>

<main id="main" class="site-main" role="main">

    <section class="recent-posts">

        <h2 class="section-title"><?php _e('Search Results for','wpzoom');?> <strong>"<?php the_search_query(); ?>"</strong></h2>

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php

                get_template_part( 'content', get_post_format() );
                ?>

            <?php endwhile; ?>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .recent-posts -->

</main><!-- .site-main -->

<?php
get_footer();
