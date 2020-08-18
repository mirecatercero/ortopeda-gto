<?php
/**
 * Template Name: Full-width Gallery
 */

get_header(); ?>

<main id="main" class="site-main full-width" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( (has_post_thumbnail() ? ' has-post-cover' : '') ); ?>>
            <div class="entry-cover">
                <?php $entryCoverBackground = get_the_image( array( 'size' => 'entry-cover', 'format' => 'array', 'attachment' => false, 'image_scan' => false ) ); ?>
                <?php if ( isset( $entryCoverBackground['src'] ) ) : ?>

                    <div class="entry-cover-image" style="background-image: url('<?php echo $entryCoverBackground['src'] ?>');"></div>

                <?php endif; ?>

                <header class="entry-header">
                    <div class="entry-info">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    </div>
                </header><!-- .entry-header -->
            </div><!-- .entry-cover -->

            <div class="entry-content">
                <?php the_content(); ?>
                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'wpzoom' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div><!-- .entry-content -->

        </article><!-- #post-## -->

    <?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
