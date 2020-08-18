<?php


/* Registering metaboxes
============================================*/

add_action( 'admin_menu', 'wpzoom_options_box' );

function wpzoom_options_box() {

    add_meta_box( 'wpzoom_top_button', 'Slideshow Options', 'wpzoom_top_button_options', 'slider', 'side', 'high' );

    add_meta_box( 'wpzoom_video_background', 'Video Background', 'wpzoom_home_slider_video_background', 'slider', 'normal', 'high' );
    add_meta_box( 'wpzoom_popup_video', 'Video Lightbox', 'wpzoom_home_slider_popup_video', 'slider', 'normal', 'high' );

    add_meta_box(
        'wpzoom_portfolio_popup',
        'Video Lightbox',
        'wpzoom_portolio_popup',
        'portfolio_item',
        'normal',
        'high'
    );


}


function wpz_newpost_head() {
    ?><style type="text/css">
        fieldset.fieldset-show { padding: 0.3em 0.8em 1em;margin-top:20px; border: 1px solid rgba(0, 0, 0, 0.2); -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; }
        fieldset.fieldset-show p { margin: 0 0 1em; }
        fieldset.fieldset-show p:last-child { margin-bottom: 0; }

        .wpz_list { font-size: 12px; }
        .wpz_border { border-bottom: 1px solid #EEEEEE; padding: 0 0 10px; }

    </style><?php
}
add_action('admin_head-post-new.php', 'wpz_newpost_head', 100);
add_action('admin_head-post.php', 'wpz_newpost_head', 100);

/**
 * Portfolio metabox content
 */

function wpzoom_portolio_popup () {
    global $post;

    $postmeta_videotype = get_post_meta($post->ID, 'wpzoom_portfolio_popup_video_type', true);
    $post_meta = empty($postmeta_videotype) ? 'self_hosted' : $postmeta_videotype; ?>

    <div class="radio-switcher">

        <p class="description">Using this option you can display a video in a lightbox which can be opened clicking on the <strong>Play</strong> button.</p>

        <label><input type="radio" name="wpzoom_portfolio_popup_video_type"
                      value="self_hosted" <?php checked($post_meta, 'self_hosted'); ?>> <?php _e('Self Hosted File', 'wpzoom') ?>
        </label>
        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="wpzoom_portfolio_popup_video_type"
                                        value="external_hosted" <?php checked($post_meta, 'external_hosted'); ?>> <?php _e('YouTube / Vimeo', 'wpzoom') ?>
        </label>
    </div>

    <div class="wpzoom_self_hosted switch-wrapper">

        <br />
        <div class="wp-media-buttons" data-button="Set Video" data-title="Set Video" data-target="#wpzoom_portfolio_video_popup_url">
            <a href="#" class="button add_media wpz-upload-video-control" title="Upload Video">
                <span class="wp-media-buttons-icon"></span>
                <?php _e('Upload Video', 'wpzoom'); ?>
            </a>
        </div>

        <div class="clear"></div>

        <p>
            <label>
                <strong><?php _e( 'MP4 (h.264) video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_portfolio_video_popup_url_mp4" id="wpzoom_portfolio_video_popup_url_mp4" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_portfolio_video_popup_url_mp4', true ) ); ?>" />

        <p class="description"><?php _e('This format is supported by most of the browsers and mobile devices.', 'wpzoom'); ?>
            </label>
        </p>

        <div class="wpz_border"></div>

        <p>
            <label>
                <strong><?php _e( 'WebM video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_portfolio_video_popup_url_webm" id="wpzoom_portfolio_video_popup_url_webm" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_portfolio_video_popup_url_webm', true ) ); ?>" />

        <p class="description"><?php _e('This format is needed for <strong>Mozilla Firefox</strong> browser.', 'wpzoom'); ?>
            </label>
        </p>

    </div>

    <div class="wpzoom_external_hosted switch-wrapper">
        <p>
            <label for="wpzoom_portfolio_video_popup_url"><strong><?php _e('','wpzoom'); ?></strong>  <em>(YouTube and Vimeo only)</em></label>
        </p>
        <p>

            <label for="wpzoom_portfolio_video_popup_url"><strong><?php _e('Insert Video Url','wpzoom'); ?></strong>  <em>(YouTube and Vimeo only)</em></label>
            <input type="text"
                   id="wpzoom_portfolio_video_popup_url"
                   class="preview-video-input widefat"
                   name="wpzoom_portfolio_video_popup_url"
                   data-nonce="<?php echo wp_create_nonce( '_action_get_oembed_response' )?>"
                   value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_portfolio_video_popup_url', true ) ); ?>"/>
        </p>
        <div class="wpzoom_video_external_preview">

        </div>
    </div>
    <?php
}

/* Slideshow Options
============================================*/
function wpzoom_top_button_options() {
    global $post;

    ?>

    <div>
        <strong><label for="wpzoom_slide_url"><?php _e( 'Slide URL', 'wpzoom' ); ?></label></strong> (<?php _e('optional', 'wpzoom'); ?>)<br/>
        <p><input type="text" name="wpzoom_slide_url" id="wpzoom_slide_url" class="widefat" value="<?php echo esc_url( get_post_meta( $post->ID, 'wpzoom_slide_url', true ) ); ?>"/></p>
        <p class="description"><?php _e('When a URL is added, the title of the current slide will become clickable', 'wpzoom'); ?></p>

    </div>


    <fieldset class="fieldset-show">
        <legend><strong><?php _e( 'Slide Button', 'wpzoom' ); ?></strong> <?php _e( '(optional)', 'wpzoom' ); ?></legend>

        <p>
            <label>
                <strong><?php _e( 'Title', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_slide_button_title" id="wpzoom_slide_button_title" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_slide_button_title', true ) ); ?>" />
            </label>
        </p>

        <p>
            <label>
                <strong><?php _e( 'URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_slide_button_url" id="wpzoom_slide_button_url" class="widefat" value="<?php echo esc_url( get_post_meta( $post->ID, 'wpzoom_slide_button_url', true ) ); ?>" />
            </label>
        </p>
   </fieldset>





<?php
}
function wpzoom_home_slider_popup_video () {
    global $post;

    $postmeta_videotype = get_post_meta($post->ID, 'wpzoom_home_slider_popup_video_type', true);
    $post_meta = empty($postmeta_videotype) ? 'self_hosted' : $postmeta_videotype; ?>

    <div class="radio-switcher">

    <p class="description">Using this option you can display a video in a lightbox which can be opened clicking on the <strong>Play</strong> button.</p>

    <label><input type="radio" name="wpzoom_home_slider_popup_video_type"
                  value="self_hosted" <?php checked($post_meta, 'self_hosted'); ?>> <?php _e('Self Hosted File', 'wpzoom') ?>
    </label>
    <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="wpzoom_home_slider_popup_video_type"
                                    value="external_hosted" <?php checked($post_meta, 'external_hosted'); ?>> <?php _e('YouTube / Vimeo', 'wpzoom') ?>
    </label>
    </div>

    <div class="wpzoom_self_hosted switch-wrapper">

        <br />
        <div class="wp-media-buttons" data-button="Set Video" data-title="Set Video" data-target="#wpzoom_home_slider_video_popup_url">
            <a href="#" id="wpzoom-home-slider-video-bg-insert-media-button" class="button add_media wpz-upload-video-control" title="Upload Video">
                <span class="wp-media-buttons-icon"></span>
                <?php _e('Upload Video', 'wpzoom'); ?>
            </a>
        </div>

        <div class="clear"></div>

        <p>
            <label>
                <strong><?php _e( 'MP4 (h.264) video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_home_slider_video_popup_url_mp4" id="wpzoom_home_slider_video_popup_url_mp4" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_popup_url_mp4', true ) ); ?>" />

        <p class="description"><?php _e('This format is supported by most of the browsers and mobile devices.', 'wpzoom'); ?>
            </label>
        </p>

        <div class="wpz_border"></div>

        <p>
            <label>
                <strong><?php _e( 'WebM video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_home_slider_video_popup_url_webm" id="wpzoom_home_slider_video_popup_url_webm" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_popup_url_webm', true ) ); ?>" />

        <p class="description"><?php _e('This format is needed for <strong>Mozilla Firefox</strong> browser.', 'wpzoom'); ?>
            </label>
        </p>

    </div>

    <div class="wpzoom_external_hosted switch-wrapper">
        <p>
            <label for="wpzoom_home_slider_video_popup_url"><strong><?php _e('','wpzoom'); ?></strong>  <em>(YouTube and Vimeo only)</em></label>
        </p>
        <p>

            <label for="wpzoom_home_slider_video_popup_url"><strong><?php _e('Insert Video Url','wpzoom'); ?></strong>  <em>(YouTube and Vimeo only)</em></label>
            <input type="text"
                   id="wpzoom_home_slider_video_popup_url"
                   class="preview-video-input widefat"
                   name="wpzoom_home_slider_video_popup_url"
                   data-nonce="<?php echo wp_create_nonce( '_action_get_oembed_response' )?>"
                   value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_popup_url', true ) ); ?>"/>
        </p>
        <div class="wpzoom_home_slider_video_external_preview">

        </div>
    </div>
    <?php
}

function wpzoom_home_slider_video_background() {
    global $post;
    ?>


    <p class="description"><?php _e('In this area you can upload a video which will play on the desktop computers in the background of the current slide continuously and muted by default.', 'wpzoom'); ?></p>


    <div class="radio-switcher">

        <h3>Select Video Source:</h3>

        <?php
        $postmeta_videotype = get_post_meta($post->ID, 'wpzoom_home_slider_video_type', true);
        $post_meta = empty($postmeta_videotype) ? 'self_hosted' : $postmeta_videotype; ?>
        <label><input type="radio" name="wpzoom_home_slider_video_type"
                      value="self_hosted" <?php checked($post_meta, 'self_hosted'); ?>> <?php _e('Self Hosted File', 'wpzoom') ?>
        </label>
        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="wpzoom_home_slider_video_type"
                      value="external_hosted" <?php checked($post_meta, 'external_hosted'); ?>> <?php _e('YouTube', 'wpzoom') ?>
        </label>
    </div>



    <div class="wpzoom_self_hosted switch-wrapper">

        <br />
        <div class="wp-media-buttons" data-button="Set Video" data-title="Set Video" data-target="#wpzoom_home_slider_video_bg_url">
            <a href="#" id="wpzoom-home-slider-video-bg-insert-media-button" class="button add_media wpz-upload-video-control" title="Upload Video">
                <span class="wp-media-buttons-icon"></span>
                <?php _e('Upload Video', 'wpzoom'); ?>
            </a>
        </div>

        <div class="clear"></div>

        <p>
            <label>
                <strong><?php _e( 'MP4 (h.264) video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_home_slider_video_bg_url_mp4" id="wpzoom_home_slider_video_bg_url_mp4" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_bg_url_mp4', true ) ); ?>" />

                <p class="description"><?php _e('This format is supported by most of the browsers and mobile devices.', 'wpzoom'); ?>
            </label>
        </p>

        <div class="wpz_border"></div>

        <p>
            <label>
                <strong><?php _e( 'WebM video URL', 'wpzoom' ); ?></strong>
                <input type="text" name="wpzoom_home_slider_video_bg_url_webm" id="wpzoom_home_slider_video_bg_url_webm" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_bg_url_webm', true ) ); ?>" />

                <p class="description"><?php _e('This format is needed for <strong>Mozilla Firefox</strong> browser.', 'wpzoom'); ?>
            </label>
        </p>

    </div>





    <div class="wpzoom_external_hosted switch-wrapper">
    <p>
        <label for="wpzoom_home_slider_video_external_url"><strong><?php _e('Insert Video Url','wpzoom'); ?></strong>  <em>(YouTube only)</em></label>
        <input type="text"
               id="wpzoom_home_slider_video_external_url"
               name="wpzoom_home_slider_video_external_url"
               class="preview-video-input widefat"
               data-nonce="<?php echo wp_create_nonce( '_action_get_oembed_response' )?>"
               value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_external_url', true ) ); ?>"/>
    </p>
        <div class="wpzoom_video_external_preview">
        </div>
    </div>

    <div class="wpz_border"></div>

    <h3><?php _e('Video Background Controls', 'wpzoom')?></h3>

    <p class="description">Video controls will appear in the bottom right corner</p>

        <p>
            <label>

                <input type="hidden" name="wpzoom_slide_play_button" value="0" />
                <input type="checkbox" name="wpzoom_slide_play_button" id="wpzoom_slide_play_button" class="widefat" value="1" <?php checked( get_post_meta( $post->ID, 'wpzoom_slide_play_button', true ) == '' ? true :  get_post_meta( $post->ID, 'wpzoom_slide_play_button', true )); ?>/>  <?php _e('Show Play/Pause Button','wpzoom') ?>

            </label>
        </p>
        <p>
            <label>

                <input type="hidden" name="wpzoom_slide_mute_button" value="0" />
                <input type="checkbox" name="wpzoom_slide_mute_button" id="wpzoom_slide_mute_button" class="widefat" value="1" <?php checked( get_post_meta( $post->ID, 'wpzoom_slide_mute_button', true ) == '' ? true :  get_post_meta( $post->ID, 'wpzoom_slide_mute_button', true )); ?>/> <?php _e('Show Mute/Unmute Button','wpzoom') ?>
            </label>
        </p>

        <div class="wpz_border"></div>



    <h3><?php _e('Video Background Options', 'wpzoom')?></h3>

        <p>
            <label>


                <input type="hidden" name="wpzoom_slide_autoplay_video_action" value="0" />
                <input type="checkbox" name="wpzoom_slide_autoplay_video_action" id="wpzoom_slide_autoplay_video_action" class="widefat" value="1" <?php checked( get_post_meta( $post->ID, 'wpzoom_slide_autoplay_video_action', true ) == ''? true :  get_post_meta( $post->ID, 'wpzoom_slide_autoplay_video_action', true )); ?>/> <?php _e('Autoplay Video','wpzoom') ?>
            </label>
        </p>
        <p>
            <label>

                <input type="hidden" name="wpzoom_slide_mute_video_action" value="0" />
                <input type="checkbox" name="wpzoom_slide_mute_video_action" id="wpzoom_slide_mute_video_action" class="widefat" value="1" <?php checked( get_post_meta( $post->ID, 'wpzoom_slide_mute_video_action', true ) == ''? true :  get_post_meta( $post->ID, 'wpzoom_slide_mute_video_action', true )); ?>/> <?php _e('Mute Video','wpzoom') ?>
            </label>
        </p>
    </fieldset>


    <div class="wpz_border"></div>
    <p>
        <em><strong>Tips:</strong></em><br/>
        <ol class="wpz_list">
            <li>If your server can't play MP4 videos, check this <a href="http://www.wpzoom.com/docs/enable-mp4-video-support-linuxapache-server/" target="_blank">tutorial</a> for a fix.</li>
            <li>Your <strong>MP4</strong> videos must have the <em>H.264</em> encoding. You can convert your videos with <a href="http://handbrake.fr/downloads.php" target="_blank">HandBrake</a> video converter.</li>
            <li>Check out <a href="http://mazwai.com/" target="_blank">Mazwai</a> for a collection of free stock videos.</li>

        </ol>
    </p>
    <br/>

    <?php
}

add_filter( 'upload_mimes','inspiro_add_custom_mime_types' );
function inspiro_add_custom_mime_types( $mimes ) {
    return array_merge( $mimes, array(
        'webm' => 'video/webm',
    ) );
}


add_action( 'save_post', 'custom_add_save' );

function custom_add_save( $postID ) {

    // called after a post or page is saved
    if ( $parent_id = wp_is_post_revision( $postID ) ) {
        $postID = $parent_id;
    }


    if ( isset( $_POST['save'] ) || isset( $_POST['publish'] ) ) {

        if ( isset( $_POST['wpzoom_home_slider_video_type'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_home_slider_video_type'] , 'wpzoom_home_slider_video_type' );

        if ( isset( $_POST['wpzoom_home_slider_popup_video_type'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_home_slider_popup_video_type'] , 'wpzoom_home_slider_popup_video_type' );

        if ( isset( $_POST['wpzoom_slide_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_slide_url'] ), 'wpzoom_slide_url' );

        if ( isset( $_POST['wpzoom_slide_button_title'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_button_title'] , 'wpzoom_slide_button_title' );

        if ( isset( $_POST['wpzoom_slide_button_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_slide_button_url'] ), 'wpzoom_slide_button_url' );

        if ( isset( $_POST['wpzoom_slide_play_button'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_play_button'], 'wpzoom_slide_play_button' );

        if ( isset( $_POST['wpzoom_slide_mute_button'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_mute_button'], 'wpzoom_slide_mute_button' );

        if ( isset( $_POST['wpzoom_slide_autoplay_video_action'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_autoplay_video_action'], 'wpzoom_slide_autoplay_video_action' );

        if ( isset( $_POST['wpzoom_slide_mute_video_action'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_mute_video_action'], 'wpzoom_slide_mute_video_action' );

        if ( isset( $_POST['wpzoom_home_slider_video_bg_url_mp4'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_bg_url_mp4'] ), 'wpzoom_home_slider_video_bg_url_mp4' );

        if ( isset( $_POST['wpzoom_home_slider_video_bg_url_webm'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_bg_url_webm'] ), 'wpzoom_home_slider_video_bg_url_webm' );

        if ( isset( $_POST['wpzoom_home_slider_video_popup_url_mp4'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_popup_url_mp4'] ), 'wpzoom_home_slider_video_popup_url_mp4' );

        if ( isset( $_POST['wpzoom_home_slider_video_popup_url_webm'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_popup_url_webm'] ), 'wpzoom_home_slider_video_popup_url_webm' );

        if ( isset( $_POST['wpzoom_home_slider_video_external_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_external_url'] ), 'wpzoom_home_slider_video_external_url' );

        if ( isset( $_POST['wpzoom_home_slider_video_popup_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_popup_url'] ), 'wpzoom_home_slider_video_popup_url' );

        // Porfolio metakeys
        if ( isset( $_POST['wpzoom_portfolio_popup_video_type'] ) ) {
            update_post_meta( $postID, 'wpzoom_portfolio_popup_video_type', $_POST['wpzoom_portfolio_popup_video_type'] );
        }

        if ( isset( $_POST['wpzoom_portfolio_video_popup_url_mp4'] ) ) {
            update_post_meta( $postID, 'wpzoom_portfolio_video_popup_url_mp4', esc_url_raw( $_POST['wpzoom_portfolio_video_popup_url_mp4'] ) );
        }

        if ( isset( $_POST['wpzoom_portfolio_video_popup_url_webm'] ) ) {
            update_post_meta( $postID, 'wpzoom_portfolio_video_popup_url_webm', esc_url_raw( $_POST['wpzoom_portfolio_video_popup_url_webm'] ) );
        }

        if ( isset( $_POST['wpzoom_portfolio_video_external_url'] ) ) {
            update_post_meta( $postID, 'wpzoom_portfolio_video_external_url', esc_url_raw( $_POST['wpzoom_portfolio_video_external_url'] ) );
        }

        if ( isset( $_POST['wpzoom_portfolio_video_popup_url'] ) ) {
            update_post_meta( $postID, 'wpzoom_portfolio_video_popup_url', esc_url_raw( $_POST['wpzoom_portfolio_video_popup_url'] ) );
        }

    }
}


function update_custom_meta( $postID, $value, $field ) {
    // To create new meta
    if ( ! get_post_meta( $postID, $field ) ) {
        add_post_meta( $postID, $field, $value );
    } else {
        // or to update existing meta
        update_post_meta( $postID, $field, $value );
    }
}

function load_admin_js(){
    wp_enqueue_script( 'slider-admin-js', get_template_directory_uri() . '/js/slider.admin.js', array( 'jquery' ), WPZOOM::$themeVersion, true );
    wp_enqueue_script( 'wpzoom-home-slider-video-background', get_template_directory_uri() . '/js/admin-video-background.js', array( 'jquery' ), WPZOOM::$themeVersion );
}

function check_current_screen(){
    $current_screen = get_current_screen();

    if($current_screen->id === 'slider' || $current_screen->id === 'portfolio_item'){
        add_action('admin_enqueue_scripts', 'load_admin_js');
    }
}
if (!function_exists('_action_get_oembed_response')) {
    function _action_get_oembed_response() {
        if ( wp_verify_nonce( $_POST['_nonce'], '_action_get_oembed_response' ) ) {
            $url        = $_POST['url'];
            $width      = 460;
            $height     = 259;
            $iframe = wp_oembed_get( $url, compact('width', 'height'));
            wp_send_json_success( array( 'response' => $iframe ) );
        }
        wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
    }
}


add_action('wp_ajax_get_oembed_response', '_action_get_oembed_response' );

add_action('current_screen','check_current_screen');


