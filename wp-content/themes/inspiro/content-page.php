<?php
/**
 * The template used for displaying page content in page.php
 */
?>

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

    <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->