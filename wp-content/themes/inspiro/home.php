<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php if ( option::is_on( 'featured_posts_show' ) && is_front_page() && $paged < 2) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<main id="main" <?php if ( ! is_front_page() ) {  post_class( (has_post_thumbnail(get_option( 'page_for_posts' )) ? ' blog-with-post-cover' : '') ); } ?> role="main">

    <section class="blog-archive">

        <?php if ( ! is_front_page() ) { ?>

            <div class="blog-header-cover">
                <?php $entryCoverBackground = get_the_image( array( 'size' => 'entry-cover', 'post_id' => get_option( 'page_for_posts' ), 'format' => 'array', 'attachment' => false, 'image_scan' => false ) ); ?>
                <?php if ( isset( $entryCoverBackground['src'] ) ) : ?>

                    <div class="blog-header-cover-image" style="background-image: url('<?php echo $entryCoverBackground['src'] ?>');"></div>

                <?php endif; ?>

                <div class="blog-header-info">
                    <div class="entry-info">
                        <h2 class="section-title"> <?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h2>

                        <div class="entry-header-excerpt">
                            <?php $blog_page = get_post( get_option( 'page_for_posts' ) );

                            $excerpt = ( $blog_page->post_excerpt ) ? $blog_page->post_excerpt : $blog_page->post_content;

                            echo $excerpt; ?>
                        </div>

                    </div>
                </div><!-- .blog-header-info -->

            </div><!-- .blog-header-cover -->

        <?php } ?>

        <section class="recent-posts">

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

    </section><!-- .blog-archive -->


</main><!-- .site-main -->

<?php
get_footer();
