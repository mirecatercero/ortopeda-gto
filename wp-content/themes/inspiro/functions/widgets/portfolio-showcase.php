<?php

/*------------------------------------------*/
/* WPZOOM: Portfolio Showcase               */
/*------------------------------------------*/

class Wpzoom_Portfolio_Showcase extends WP_Widget {

    protected $defaults = array();

    function __construct() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'portfolio-showcase', 'description' => 'Portfolio posts shown as a gallery.' );

        /* Widget control settings. */
        $control_ops = array( 'id_base' => 'wpzoom-portfolio-showcase' );

        $this->defaults = array(
            'title'            => '',
            'category'         => 0,
            'col_number'       => 3,
            'show_masonry'     => false,
            'show_popup'       => true,
            'show_count'       => 6,
            'show_excerpt'     => true,
            'view_all_btn'     => true,
            'readmore_text'    => 'Read More',
            'view_all_enabled' => true,
            'view_all_text'    => 'View All',
            'view_all_link'    => '#'
        );

        /* Create the widget. */
        parent::__construct( 'wpzoom-portfolio-showcase', 'WPZOOM: Portfolio Showcase', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters( 'widget_title', $instance['title'] );
        $category = $instance['category'];
        $show_count = $instance['show_count'];
        $col_number = $instance['col_number'];
        $show_masonry = $instance['show_masonry'] == true;
        $show_popup = $instance['show_popup'] == true;
        $show_excerpt = $instance['show_excerpt'] == true;
        $view_all_btn = $instance['view_all_btn'] == true;
        $view_all_enabled = $instance['view_all_enabled'] == true;
        $readmore_text = $instance['readmore_text'];
        $view_all_text = $instance['view_all_text'];
        $view_all_link = $instance['view_all_link'];

        /* Before widget (defined by themes). */
        echo $before_widget;

        /* Title of widget (before and after defined by themes). */
        if ( $title )
            echo $before_title . $title . $after_title;

        $args = array(
            'post_type' => 'portfolio_item',
            'posts_per_page' => $show_count,
        );

        if ( $category ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio',
                    'terms' => $category,
                    'field' => 'term_id',
                )
            );
        }

        $wp_query = new WP_Query( $args );
        ?>

        <?php if ( $wp_query->have_posts() ) : ?>

            <?php if ( $show_masonry == true) { ?>
                <div id="portfolio-masonry">
            <?php } ?>


                <div class="portfolio-grid col_no_<?php echo $col_number; ?>"">

                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                        <?php
                        $articleClass = ( ! has_post_thumbnail() ) ? 'no-thumbnail ' : '';

                        $post_thumbnail = get_the_post_thumbnail_url(get_the_ID());
                        $video_background_popup_url = get_post_meta(get_the_ID(), 'wpzoom_portfolio_video_popup_url', true);
                        $background_popup_url = !empty($video_background_popup_url) ? $video_background_popup_url : $post_thumbnail;
                        $video_background_popup_url_mp4 = get_post_meta(get_the_ID(), 'wpzoom_portfolio_video_popup_url_mp4', true);
                        $video_background_popup_url_webm = get_post_meta(get_the_ID(), 'wpzoom_portfolio_video_popup_url_webm', true);
                        $video_background_popup_video_type = get_post_meta(get_the_ID(), 'wpzoom_portfolio_popup_video_type', true);
                        $popup_video_type = !empty($video_background_popup_video_type) ? $video_background_popup_video_type : 'external_hosted';
                        $is_video_popup = $video_background_popup_url_mp4 || $video_background_popup_url_webm;

                        $popup_final_external_src = !empty($video_background_popup_url_mp4) ? $video_background_popup_url_mp4 : $video_background_popup_url_webm;

                        $portfolios = wp_get_post_terms( get_the_ID(), 'portfolio' );


                        if ( $show_masonry == true) {
                            $size = "portfolio_item-masonry";
                        }
                        else {
                            $size = "portfolio_item-thumbnail";
                        }


                        if ( is_array( $portfolios ) ) {
                            foreach ( $portfolios as $portfolio ) {
                                $articleClass .= 'portfolio_' . $portfolio->term_id . '_item ';
                            }
                        }
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( $articleClass ); ?>>


                            <?php if ($show_popup) { ?>

                                <div class="entry-thumbnail-popover">
                                    <div class="entry-thumbnail-popover-content lightbox_popup_insp popover-content--animated"><!-- start lightbox --><?php if ( $popup_video_type === 'self_hosted' && $is_video_popup ): ?>
                                            <div id="zoom-popup-<?php echo the_ID(); ?>" class="animated slow mfp-hide">

                                                <div class="mfp-iframe-scaler">

                                                    <?php
                                                    echo wp_video_shortcode(
                                                        array(
                                                            'src'  => $popup_final_external_src,
                                                            'loop' => 'on'
                                                            //'autoplay' => 'on'
                                                        ) );
                                                    ?>

                                                </div>
                                            </div>
                                            <a href="#zoom-popup-<?php echo the_ID(); ?>"
                                               class="mfp-inline portfolio-popup-video"></a>
                                        <?php elseif ( ! empty( $video_background_popup_url ) ): ?><a
                                               class="mfp-iframe portfolio-popup-video"
                                               href="<?php echo $video_background_popup_url ?>"></a>
                                       <?php else: ?>
                                           <a
                                              class="mfp-image portfolio-popup-video popup_image_insp"
                                              href="<?php echo $post_thumbnail ?>"></a>
                                        <?php endif; ?>

                                        <h3 class="portfolio_item-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h3>

                                    </div>
                                </div>

                                <?php if ( has_post_thumbnail() )  : ?>

                                   <?php the_post_thumbnail( $size ); ?>

                                <?php else: ?>

                                    <img width="600" height="400" src="<?php echo get_template_directory_uri() . '/images/portfolio_item-placeholder.gif'; ?>">

                                <?php endif; ?>


                            <?php } else { ?>

                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

                                    <div class="entry-thumbnail-popover">
                                        <div class="entry-thumbnail-popover-content popover-content--animated">
                                            <?php the_title( '<h3 class="portfolio_item-title">', '</h3>' ); ?>

                                            <?php if ( $show_excerpt == true ) : ?>

                                                <?php the_excerpt(); ?>

                                            <?php endif; ?>

                                            <?php if ( $view_all_btn == true ) : ?>

                                                <span class="btn"><?php echo esc_html( $readmore_text ); ?></span>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ( has_post_thumbnail() )  : ?>

                                       <?php the_post_thumbnail( $size ); ?>

                                    <?php else: ?>

                                        <img width="600" height="400" src="<?php echo get_template_directory_uri() . '/images/portfolio_item-placeholder.gif'; ?>">

                                    <?php endif; ?>

                                </a>

                            <?php } ?>

                        </article><!-- #post-## -->

                    <?php endwhile; ?>

                </div>


            <?php if ( $show_masonry == true) { ?>
                </div>
            <?php } ?>

        <?php endif; ?>


        <?php if ( $view_all_enabled ) : ?>

            <div class="portfolio-view_all-link">
                <a class="btn" href="<?php echo esc_url( $view_all_link ); ?>" title="<?php echo esc_attr( $view_all_text ); ?>">
                    <?php echo esc_html( $view_all_text ); ?>
                </a>
            </div><!-- .portfolio-view_all-link -->

        <?php endif; ?>


        <?php
        /* After widget (defined by themes). */
        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags (if needed) and update the widget settings. */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['category'] = $new_instance['category'];
        $instance['show_count'] = $new_instance['show_count'];
        $instance['col_number'] = $new_instance['col_number'];
        $instance['show_masonry']     = isset( $new_instance['show_masonry'] );
        $instance['show_popup']       = isset( $new_instance['show_popup'] );
        $instance['show_excerpt']     = isset($new_instance['show_excerpt']);
        $instance['view_all_btn']     = isset($new_instance['view_all_btn']);
        $instance['view_all_enabled'] = isset($new_instance['view_all_enabled']);
        $instance['readmore_text'] = $new_instance['readmore_text'];
        $instance['view_all_text'] = $new_instance['view_all_text'];
        $instance['view_all_link'] = $new_instance['view_all_link'];

        return $instance;
    }

    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>">Category:</label>
            <select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
                <option value="0" <?php if ( ! $instance['category'] ) echo 'selected="selected"'; ?>>All</option>
                <?php
                $categories = get_categories( array( 'taxonomy' => 'portfolio' ) );

                foreach( $categories as $cat ) {
                    echo '<option value="' . $cat->cat_ID . '"';

                    if ( $cat->cat_ID == $instance['category'] ) echo  ' selected="selected"';

                    echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';

                    echo '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
            <input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" type="text" size="2" /> portfolio posts
        </p>


        <hr />

        <div>
            <label for="<?php echo $this->get_field_id( 'col_number' ); ?>"><?php _e('Preferred number of columns', 'wpzoom'); ?>: </label>
            <select id="<?php echo $this->get_field_id( 'col_number' ); ?>" name="<?php echo $this->get_field_name( 'col_number' ); ?>">
                <option value="3" <?php if ( $instance['col_number'] == '3' ) echo 'selected="selected"'; ?>><?php _e('3', 'wpzoom'); ?></option>
                <option value="4" <?php if ( $instance['col_number'] == '4' ) echo 'selected="selected"'; ?>><?php _e('4', 'wpzoom'); ?></option>
                <option value="5" <?php if ( $instance['col_number'] == '5' ) echo 'selected="selected"'; ?>><?php _e('5', 'wpzoom'); ?></option>

            </select>
            <span class="howto"><?php _e('The number of columns may vary depending on user\'s screen size', 'wpzoom'); ?></span>
        </div>


        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['show_popup'] ); ?> id="<?php echo $this->get_field_id( 'show_popup' ); ?>" name="<?php echo $this->get_field_name( 'show_popup' ); ?>" />
                <?php _e( 'Enable Lightbox', 'wpzoom' ); ?>
            </label>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['show_masonry'] ); ?> id="<?php echo $this->get_field_id( 'show_masonry' ); ?>" name="<?php echo $this->get_field_name( 'show_masonry' ); ?>" />
                <?php _e( 'Display Posts in Masonry Layout', 'wpzoom' ); ?>
            </label>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['show_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
                <?php _e( 'Display Excerpts <small><em>(doesn\'t work with Lightbox feature)</em></small>', 'wpzoom' ); ?>
            </label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['view_all_btn'] ); ?> id="<?php echo $this->get_field_id( 'view_all_btn' ); ?>" name="<?php echo $this->get_field_name( 'view_all_btn' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'view_all_btn' ); ?>"><?php _e( 'Display Read More button <small><em>(doesn\'t work with Lightbox feature)</em></small>', 'wpzoom' ); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'readmore_text' ); ?>"><?php _e( 'Text for Read More button', 'wpzoom' ); ?>:</label><br />
            <input id="<?php echo $this->get_field_id( 'readmore_text' ); ?>" name="<?php echo $this->get_field_name( 'readmore_text' ); ?>" value="<?php echo $instance['readmore_text']; ?>" type="text" class="widefat" />
        </p>

        <hr />

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['view_all_enabled'] ); ?> id="<?php echo $this->get_field_id( 'view_all_enabled' ); ?>" name="<?php echo $this->get_field_name( 'view_all_enabled' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'view_all_enabled' ); ?>"><?php _e( 'Display View All button', 'wpzoom' ); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'view_all_text' ); ?>"><?php _e( 'Text for View All button', 'wpzoom' ); ?>:</label><br />
            <input id="<?php echo $this->get_field_id( 'view_all_text' ); ?>" name="<?php echo $this->get_field_name( 'view_all_text' ); ?>" value="<?php echo $instance['view_all_text']; ?>" type="text" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'view_all_link' ); ?>"><?php _e( 'Link for View All button', 'wpzoom' ); ?>:</label><br />
            <input id="<?php echo $this->get_field_id( 'view_all_link' ); ?>" name="<?php echo $this->get_field_name( 'view_all_link' ); ?>" value="<?php echo $instance['view_all_link']; ?>" type="text" class="widefat" />
        </p>

        <?php
    }
}

function wpzoom_register_psc_widget() {
    register_widget('Wpzoom_Portfolio_Showcase');
}
add_action('widgets_init', 'wpzoom_register_psc_widget');