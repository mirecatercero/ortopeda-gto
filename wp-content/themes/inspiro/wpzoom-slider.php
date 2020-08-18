<?php
$sliderLoop = new WP_Query(array(
    'post_type' => 'slider',
    'posts_per_page' => option::get('featured_posts_posts')
));

$slide_counter = 0;
?>


    <?php if ($sliderLoop->have_posts()) : ?>
<div id="slider" data-posts="<?php echo count($sliderLoop->posts)?>">

        <ul class="slides">

            <?php while ($sliderLoop->have_posts()) : $sliderLoop->the_post(); ?>

                <?php
                $slide_url = trim(get_post_meta(get_the_ID(), 'wpzoom_slide_url', true));
                $btn_title = trim(get_post_meta(get_the_ID(), 'wpzoom_slide_button_title', true));
                $btn_url = trim(get_post_meta(get_the_ID(), 'wpzoom_slide_button_url', true));
                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured');
                $small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-small');
                $video_background_mp4 = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_bg_url_mp4', true);
                $video_background_webm = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_bg_url_webm', true);
                $video_background_external_url = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_external_url', true);
                $video_background_popup_url = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_popup_url', true);
                $video_background_popup_url_mp4 = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_popup_url_mp4', true);
                $video_background_popup_url_webm = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_popup_url_webm', true);
                $post_meta_of_external_hosted = get_post_meta(get_the_ID(), 'wpzoom_home_slider_video_type', true);
                $show_play_button = (bool) (get_post_meta($post->ID, 'wpzoom_slide_play_button', true) == '' ? true : get_post_meta($post->ID, 'wpzoom_slide_play_button', true));
                $show_sound_button = (bool) (get_post_meta($post->ID, 'wpzoom_slide_mute_button', true) == '' ? true : get_post_meta($post->ID, 'wpzoom_slide_mute_button', true));
                $autoplay = (bool) (get_post_meta($post->ID, 'wpzoom_slide_autoplay_video_action', true) == '' ? true : get_post_meta($post->ID, 'wpzoom_slide_autoplay_video_action', true));
                $sound = (bool) (get_post_meta($post->ID, 'wpzoom_slide_mute_video_action', true) == '' ? true : get_post_meta($post->ID, 'wpzoom_slide_mute_video_action', true));
                $v_type = get_post_meta($post->ID, 'wpzoom_home_slider_popup_video_type', true);
                $popup_video_type = !empty($v_type) ? $v_type : 'external_hosted';
                $popup_final_external_src = !empty($video_background_popup_url_mp4) ? $video_background_popup_url_mp4 : $video_background_popup_url_webm;
                $is_video_slide = $video_background_mp4 || $video_background_webm;
                $is_video_popup = $video_background_popup_url_mp4 || $video_background_popup_url_webm;

                $slide_counter++;

                $style = '';

                $source = array(
                    'poster' => ''
                );

                if (!empty($large_image_url)) {
                    $source['poster'] = $large_image_url[0];
                }
                if (wp_oembed_get($video_background_external_url)) {
                    $source['video'] = $video_background_external_url;
                }
                if (!empty($video_background_mp4)) {
                    $source['mp4'] = $video_background_mp4;
                }
                if (!empty($video_background_webm)) {
                    $source['webm'] = $video_background_webm;
                }

                $encode_array = array(
                    'source' => $source,
                    'autoPlay' => $autoplay,
                    'mute' => $sound
                );

                if (!$is_video_slide || option::is_on('slideshow_video_fallback')) {
                    $style = ' data-smallimg="' . $small_image_url[0] . '" data-bigimg="' . $large_image_url[0] . '"';

                    if ($slide_counter === 1) {
                        $style .= ' style="background-image:url(\'' . $large_image_url[0] . '\')"';
                    }
                }
                ?>

                <li <?php echo $style; ?>
                    data-background-options='<?php echo json_encode($encode_array); ?>'>

                    <?php if (option::is_on('slideshow_overlay')) : ?>

                        <div class="slide-background-overlay"></div>

                    <?php endif; ?>


                    <div class="li-wrap">


                        <?php if (option::is_on('slideshow_title')) : ?>

                            <?php if (empty($slide_url)) : ?>

                                <?php the_title('<h3 class="missing-url">', '</h3>'); ?>

                            <?php else: ?>

                                <?php the_title(sprintf('<h3><a href="%s">', esc_url($slide_url)), '</a></h3>'); ?>

                            <?php endif; ?>

                        <?php endif; ?>


                        <?php if (option::is_on('slideshow_excerpt')) : ?>

                            <div class="excerpt"><?php the_excerpt(); ?></div>

                        <?php endif; ?>

                        <?php if (!empty($btn_title) && !empty($btn_url)) {
                            ?>
                            <div class="slide_button">
                            <a  href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($btn_title); ?></a>
                            </div><?php
                        } ?>

                        <?php if($popup_video_type === 'self_hosted' && $is_video_popup): ?>
                            <div id="zoom-popup-<?php echo $post->ID?>"  class="animated slow mfp-hide" data-src ="<?php echo $popup_final_external_src ?>">


                                <div class="mfp-iframe-scaler">


                                <?php
                                echo  wp_video_shortcode(
                                    array(
                                        'src' => $popup_final_external_src,
                                        'loop' => 'on'
                                        //'autoplay' => 'on'
                                    ));
                                ?>

                                </div>
                            </div>
                            <a href="#zoom-popup-<?php echo $post->ID?>"  data-popup-type="inline" class="popup-video"></a>

                        <?php elseif(!empty($video_background_popup_url)): ?>
                            <a  data-popup-type="iframe" class="popup-video animated slow pulse"
                               href="<?php echo $video_background_popup_url ?>"></a>
                        <?php endif; ?>

                    </div>

                    <?php if (!empty($video_background_mp4) || !empty($video_background_webm) || wp_oembed_get($video_background_external_url)): ?>

                        <div class="background-video-buttons-wrapper">

                            <?php if ($show_play_button || !$autoplay): ?>
                                <a class="wpzoom-button-video-background-play display-none"><?php _e('Play', 'wpzoom'); ?></a>
                                <a class="wpzoom-button-video-background-pause display-none"><?php _e('Pause', 'wpzoom'); ?></a>

                            <?php endif; ?>

                            <?php if ($show_sound_button): ?>
                                <a class="wpzoom-button-sound-background-unmute display-none">Unmute</a>
                                <a class="wpzoom-button-sound-background-mute display-none">Mute</a>

                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>

        </ul>

        <?php if (option::is_on('slideshow_scroll')) : ?>
            <div id="scroll-to-content" title="<?php esc_attr_e('Scroll to Content', 'wpzoom'); ?>">
                <?php _e('Scroll to Content', 'wpzoom'); ?>
            </div>
        <?php endif; ?>
</div>
    <?php else: ?>

        <div class="empty-slider">

            <div class="wrap">

                <p><strong><?php _e('You are now ready to set-up your Slideshow content.', 'wpzoom'); ?></strong></p>

                <p>
                    <?php
                    printf(
                        __('For more information about adding posts to the slider, please <strong><a href="%1$s">read the documentation</a></strong> or <a href="%2$s">add a new post</a>.', 'wpzoom'),
                        'http://www.wpzoom.com/documentation/inspiro/',
                        admin_url('post-new.php?post_type=slider')
                    );
                    ?>
                </p>
            </div>
        </div>

    <?php endif; ?>

