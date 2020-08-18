<?php


function inspiro_customizer_data()
{
    static $data = array();

    if(empty($data)){

        $media_viewport = 'screen and (min-width: 950px)';

        $data = array(
            'title_tagline' => array(
                'title' => __('Site Identity', 'wpzoom'),
                'priority' => 20,
                'options' => array(
                    'custom_logo_retina_ready' => array(
                        'setting' => array(
                            'sanitize_callback' => 'absint',
                            'default' => false,
                        ),
                        'control' => array(
                            'label' => __('Retina Ready?', 'wpzoom'),
                            'type' => 'checkbox',
                            'priority' => 9
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'inspiro_custom_logo'
                        )
                    ),
                    'blogname' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogname'),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Site Title', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 9
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogname'
                        )
                    ),
                    'blogdescription' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogdescription'),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Tagline', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 10
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz .tagline',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogdescription'
                        )
                    ),
                    'custom_logo' => array(
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'inspiro_custom_logo'
                        )
                    )
                )
            ),
            'header' => array(
                'title' => __('Header Options', 'wpzoom'),
                'priority' => 50,
                'options' => array(
                    'navbar-hide-search' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => 'block'
                        ),
                        'control' => array(
                            'label' => __('Show Search Form', 'wpzoom'),
                            'type' => 'checkbox',
                        ),
                        'style' => array(
                            'selector' => '.sb-search',
                            'rule' => 'display'
                        )
                    ),
                )
            ),
            'color' => array(
                'title' => __('General', 'wpzoom'),
                'panel' => 'color-scheme',
                'priority' => 110,
                'capability' => 'edit_theme_options',
                'options' => array(

                    'color-accent' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Accent Color', 'wpzoom'),
                            'description' => 'If this option affects the menu, just refresh this page, as this happens only in Customizer.'
                        ),

                        'style' => array(
                            array(
                                'selector' => 'a,
                                    .comment-author .fn a:hover,
                                    .zoom-twitter-widget a,
                                    .woocommerce-pagination .page-numbers,
                                    .paging-navigation .page-numbers,
                                    .page .post_author a,
                                    .single .post_author a,
                                     .button:hover, .button:focus, .btn:hover, .more-link:hover, .more_link:hover, .side-nav .search-form .search-submit:hover, .site-footer .search-form .search-submit:hover, .btn:focus, .more-link:focus, .more_link:focus, .side-nav .search-form .search-submit:focus, .site-footer .search-form .search-submit:focus, .infinite-scroll #infinite-handle span:hover,
                                    .btn-primary, .side-nav .search-form .search-submit, .site-footer .search-form .search-submit,
                                    .woocommerce-pagination .page-numbers.current, .woocommerce-pagination .page-numbers:hover, .paging-navigation .page-numbers.current, .paging-navigation .page-numbers:hover, .featured_page_wrap--with-background .btn:hover, .fw-page-builder-content .feature-posts-list h3 a:hover,
.widgetized-section .feature-posts-list h3 a:hover, .widgetized-section .featured-products .price:hover, .portfolio-view_all-link .btn:hover, .portfolio-archive-taxonomies a:hover, .entry-thumbnail-popover-content h3:hover, .entry-thumbnail-popover-content span:hover, .entry-thumbnail-popover-content .btn:hover, .entry-title a:hover, .entry-meta a:hover, .page .has-post-cover .entry-header .entry-meta a:hover,
.single .has-post-cover .entry-header .entry-meta a:hover, .page .post_author a:hover,
.single .post_author a:hover, .single #jp-relatedposts .jp-relatedposts-items-visual h4.jp-relatedposts-post-title a:hover, .comment-author .fn a:hover, .site-info a:hover, .woocommerce-page #content input.button:focus, .woocommerce-page ul.products li.product .price, .woocommerce-page div.product span.price, .woocommerce-page #content input.button.alt, .woocommerce-pagination .page-numbers:hover, .woocommerce-message::before, .fw_theme_bg_color_1 input[type=submit]:hover, .fw-page-builder-content .fw_theme_bg_color_1 .feature-posts-list h3 a:hover, .fw_theme_bg_color_2 input[type=submit]:hover, .fw-section-image .btn:hover, .wpz-btn:hover,.wpz-btn:focus, .fw-section-image .wpz-btn:hover, .fw-pricing-container .wpz-btn:hover#main .woocommerce-page #content input.button.alt, .woocommerce-page #main  a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce #content input.button:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page #main input.button:hover, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price,
.fw-section-image .wpz-btn:focus,button:hover, input[type=button]:hover, input[type=reset]:hover, input[type=submit]:hover',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.button:hover, .button:focus, .btn:hover, .more-link:hover, .more_link:hover, .side-nav .search-form .search-submit:hover, .site-footer .search-form .search-submit:hover, .btn:focus, .more-link:focus, .more_link:focus, .side-nav .search-form .search-submit:focus, .site-footer .search-form .search-submit:focus, .infinite-scroll #infinite-handle span:hover,
                                    .btn-primary, .side-nav .search-form .search-submit, .site-footer .search-form .search-submit,
                                    input:focus, textarea:focus,
                                    .slides > li h3 a:hover:after, .slides > li .slide_button a:hover, .featured_page_wrap--with-background .btn:hover,.widgetized-section .featured-products .price:hover, .portfolio-view_all-link .btn:hover, .portfolio-archive-taxonomies a:hover, .search-form input:focus, .woocommerce-page #content input.button:focus, .woocommerce-page #content input.button.alt, .fw_theme_bg_color_1 input[type=submit]:hover, .wpz-btn:hover,
.wpz-btn:focus, .fw-section-image .wpz-btn:hover,
.fw-section-image .wpz-btn:focus, .fw-pricing-container .wpz-btn:hover, .entry-thumbnail-popover-content .btn:hover,button:hover, input[type=button]:hover, input[type=reset]:hover, input[type=submit]:hover, .woocommerce-page #main  a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce #content input.button:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page #main input.button:hover, .woocommerce-cart table.cart td.actions .coupon .input-text:focus',
                                'rule' => 'border-color'
                            ),

                            array(
                                'selector' => '.slides > li .slide_button a:hover, .woocommerce .quantity .minus:hover, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .fw_theme_bg_color_2, .overlay_color_2, .background-video, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range',
                                'rule' => 'background-color'
                            ),

                            array(
                                'selector' => '.navbar-nav > li > ul:before',
                                'rule' => 'border-bottom-color'
                            ),

                            array(
                                'selector' => '.navbar-nav a:hover, .navbar-nav ul',
                                'rule' => 'border-top-color'
                            )


                        )

                    ),


                    'color-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'body',
                            'rule' => 'background'
                        )
                    ),
                    'color-body-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Body Text', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'body, h1, h2, h3, h4, h5, h6',
                            'rule' => 'color'
                        )
                    ),
                    'color-logo' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Logo Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'rule' => 'color'
                        ),
                    ),
                    'color-logo-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Logo Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Link Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'a,.comment-author .fn, .comment-author .fn a, .zoom-twitter-widget a, .woocommerce-pagination .page-numbers, .paging-navigation .page-numbers, .page .post_author a, .single .post_author a, .comment-author a.comment-reply-link, .comment-author a.comment-edit-link',
                            'rule' => 'color'
                        )
                    ),
                    'color-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#076c65'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Link Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'a:hover, .zoom-twitter-widget a:hover, .woocommerce-pagination .page-numbers.current, .woocommerce-pagination .page-numbers:hover, .paging-navigation .page-numbers.current, .paging-navigation .page-numbers:hover, .entry-thumbnail-popover-content h3:hover, .comment-author .fn a:hover, .page .post_author a:hover, .single .post_author a:hover',
                            'rule' => 'color'
                        ),
                    ),

                    'button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button, .btn, .more-link, .more_link, .side-nav .search-form .search-submit, .portfolio-view_all-link .btn, .entry-thumbnail-popover-content .btn',
                            'rule' => 'background'
                        )
                    ),
                    'button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => 'rgba(11, 180, 170, 0.05)'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Background Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button:hover, .button:focus, .btn:hover, .more-link:hover, .more_link:hover, .side-nav .search-form .search-submit:hover, .site-footer .search-form .search-submit:hover, .btn:focus, .more-link:focus, .more_link:focus, .side-nav .search-form .search-submit:focus, .site-footer .search-form .search-submit:focus, .infinite-scroll #infinite-handle span:hover, .portfolio-view_all-link .btn:hover, .entry-thumbnail-popover-content .btn:hover',
                            'rule' => 'background'
                        )
                    ),
                    'button-border' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Border Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button, .btn, .more-link, .more_link, .side-nav .search-form .search-submit, .portfolio-view_all-link .btn, .entry-thumbnail-popover-content .btn',
                            'rule' => 'border-color'
                        )
                    ),
                    'button-border-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Border Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button:hover, .button:focus, .btn:hover, .more-link:hover, .more_link:hover, .side-nav .search-form .search-submit:hover, .site-footer .search-form .search-submit:hover, .btn:focus, .more-link:focus, .more_link:focus, .side-nav .search-form .search-submit:focus, .site-footer .search-form .search-submit:focus, .infinite-scroll #infinite-handle span:hover, .portfolio-view_all-link .btn:hover, .entry-thumbnail-popover-content .btn:hover',
                            'rule' => 'border-color'
                        )
                    ),
                    'button-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button, .btn, .more-link, .more_link, .side-nav .search-form .search-submit, .portfolio-view_all-link .btn, .entry-thumbnail-popover-content .btn',
                            'rule' => 'color'
                        )
                    ),
                    'button-color-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Text Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.button:hover, .button:focus, .btn:hover, .more-link:hover, .more_link:hover, .side-nav .search-form .search-submit:hover, .site-footer .search-form .search-submit:hover, .btn:focus, .more-link:focus, .more_link:focus, .side-nav .search-form .search-submit:focus, .site-footer .search-form .search-submit:focus, .infinite-scroll #infinite-handle span:hover, .portfolio-view_all-link .btn:hover, .entry-thumbnail-popover-content .btn:hover',
                            'rule' => 'color'
                        )
                    ),

                ),

            ),
            'color-main-menu' => array(
                'panel' => 'color-scheme',
                'title' => __('Main Menu', 'wpzoom'),
                'options' => array(
                    'color-menu-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#111111'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'id' => 'color-menu-link',
                            'selector' => '.navbar',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-menu-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item', 'wpzoom'),
                        ),
                        'style' => array(
                            'id' => 'color-menu-link',
                            'selector' => '.navbar-collapse .navbar-nav > li > a',
                            'rule' => 'color'
                        )
                    ),
                    'color-menu-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.navbar-collapse .navbar-nav > li > a:hover',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.navbar-collapse .navbar-nav > li > a:hover',
                                'rule' => 'border-bottom-color'
                            )
                        )
                    ),
                    'color-menu-link-current' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Current Item', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.navbar-collapse .navbar-nav > li.current-menu-item > a, .navbar-collapse .navbar-nav > li.current_page_item > a, .navbar-collapse .navbar-nav > li.current-menu-parent > a',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.navbar-collapse .navbar-nav > .current-menu-item a, .navbar-collapse .navbar-nav > .current_page_item a, .navbar-collapse .navbar-nav > .current-menu-parent a',
                                'rule' => 'border-bottom-color'
                            )
                        )
                    ),
                    'color-menu-dropdown' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#111111'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Dropdown Menu Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-nav ul',
                            'rule' => 'background'
                        )
                    ),
                    'color-menu-dropdown-arrow' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Dropdown Menu Arrow', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.navbar-nav ul',
                                'rule' => 'border-top-color'
                            ),
                            array(
                                'selector' => '.navbar-nav > li > ul:before',
                                'rule' => 'border-bottom-color'
                            )
                        )
                    )
                )
            ),
            'color-slider' => array(
                'panel' => 'color-scheme',
                'title' => __('Homepage Slider', 'wpzoom'),
                'options' => array(
                    'color-slider-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li h3 a, .slides li h3',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-description' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Description', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .excerpt',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-arrows' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slider Arrows', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '#slider .flex-direction-nav .flex-nav-prev .flex-prev:after, #slider .flex-direction-nav .flex-nav-next .flex-next:after',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '#slider #scroll-to-content:before',
                                'rule' => 'border-color'
                            )
                        )
                    ),
                    'color-slider-button-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Text', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-button-text-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Text Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-slider-button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Background Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a:hover',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-slider-button-border' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Border', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a',
                            'rule' => 'border-color'
                        )
                    ),
                    'color-slider-button-border-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Border Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide_button a:hover',
                            'rule' => 'border-color'
                        )
                    ),


                )
            ),
            'color-posts' => array(
                'panel' => 'color-scheme',
                'title' => __('Blog Posts', 'wpzoom'),
                'options' => array(
                    'color-post-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-title a, .fw-page-builder-content .feature-posts-list h3 a, .widgetized-section .feature-posts-list h3 a',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-title-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Title Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-title a:hover, .fw-page-builder-content .feature-posts-list h3 a:hover, .widgetized-section .feature-posts-list h3 a:hover ',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-meta' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#999999'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-meta-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.entry-meta a',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.recent-posts .entry-meta a',
                                'rule' => 'border-color'
                            )
                        )
                    ),
                    'color-post-meta-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.entry-meta a:hover',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.recent-posts .entry-meta a:hover',
                                'rule' => 'border-color'
                            )
                        )
                    ),
                    'color-post-button-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-button-color-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Text Color Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link:hover, .more_link:active',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-post-button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => 'rgba(11, 180, 170, 0.05)'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background Color Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link:hover, .more_link:active',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-post-button-border' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Border', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link',
                            'rule' => 'border-color'
                        )
                    ),
                    'color-post-button-border-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Border Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.more_link:hover, .more_link:active',
                            'rule' => 'border-color'
                        )
                    ),
                )
            ),
            'color-single' => array(
                'panel' => 'color-scheme',
                'title' => __('Individual Posts and Pages', 'wpzoom'),
                'options' => array(
                    'color-single-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post/Page Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.page h1.entry-title, .single h1.entry-title',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-title-image' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post/Page Title (with Featured Image)', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.page .has-post-cover .entry-header h1.entry-title, .single .has-post-cover .entry-header h1.entry-title',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#494949'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta', 'wpzoom'),
                        ),
                        'style' => array(
                            'id' => 'color-single-meta',
                            'selector' => '.single .entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .entry-meta a',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .entry-meta a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-image' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta (with Featured Image)', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .has-post-cover .entry-header .entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link-image' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link (with Featured Image)', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .has-post-cover .entry-header .entry-meta a',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link-hover-image' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover (with Featured Image)', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .has-post-cover .entry-header .entry-meta a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-content' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post/Page Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-content',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0bb4aa'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Links Color in Posts', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-content a',
                            'rule' => 'color'
                        )
                    ),

                )
            ),
            'color-widgets' => array(
                'panel' => 'color-scheme',
                'title' => __('Widgets', 'wpzoom'),
                'options' => array(
                    'color-widget-title-homepage' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Widget Title on Home Page', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.widget .section-title',
                            'rule' => 'color'
                        )
                    ),
                    'color-widget-title-others' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Widget Title in Sidebar and Footer', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.widget h3.title',
                            'rule' => 'color'
                        )
                    ),
                )
            ),
            'color-footer' => array(
                'panel' => 'color-scheme',
                'title' => __('Footer', 'wpzoom'),
                'options' => array(
                    'footer-background-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#1a1a1a'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.site-footer',
                            'rule' => 'background-color'
                        )
                    ),
                    'footer-background-color-separator' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#232323'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Separator Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.site-footer .site-footer-separator',
                            'rule' => 'border-color'
                        )
                    ),

                    'footer-text-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#a0a0a0'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.site-footer',
                            'rule' => 'color'
                        )
                    ),

                )
            ),
            /**
             *  Typography
             */
            'font-site-body' => array(
                'panel' => 'typography',
                'title' => __('Body', 'wpzoom'),
                'options' => array(
                    'body' => array(
                        'type' => 'typography',
                        'selector' => 'body, .footer-widgets .column, .site-info',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-site-title' => array(
                'panel' => 'typography',
                'title' => __('Site Title', 'wpzoom'),
                'options' => array(
                    'title' => array(
                        'type' => 'typography',
                        'selector' => '.navbar-brand-wpz h1 a',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 26,
                            'font-weight' => 'bold',
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-nav' => array(
                'panel' => 'typography',
                'title' => __('Menu Links', 'wpzoom'),
                'options' => array(
                    'mainmenu' => array(
                        'type' => 'typography',
                        'selector' => '.navbar-collapse a',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-slider' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Title', 'wpzoom'),
                'options' => array(
                    'slider-title' => array(
                        'type' => 'typography',
                        'selector' => '.slides li h3',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 72,
                            'font-weight' => 200,
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-slider-description' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Description', 'wpzoom'),
                'options' => array(
                    'slider-text' => array(
                        'type' => 'typography',
                        'selector' => '.slides li .excerpt',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 20,
                            'font-weight' => 'normal',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-slider-button' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Button', 'wpzoom'),
                'options' => array(
                    'slider-button' => array(
                        'type' => 'typography',
                        'selector' => '.slides > li .slide_button a',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 18,
                            'font-weight' => 'bold',
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-widgets-homepage' => array(
                'panel' => 'typography',
                'title' => __('Widget Title on Homepage', 'wpzoom'),
                'options' => array(
                    'home-widget-full' => array(
                        'type' => 'typography',
                        'selector' => '.widget .section-title',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 26,
                            'font-weight' => 'bold',
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-widgets-others' => array(
                'panel' => 'typography',
                'title' => __('Widget Title in Sidebar and Footer', 'wpzoom'),
                'options' => array(
                    'widget-title' => array(
                        'type' => 'typography',
                        'selector' => '.widget h3.title',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 20,
                            'font-weight' => 'bold',
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-post-title' => array(
                'panel' => 'typography',
                'title' => __('Blog Posts Title', 'wpzoom'),
                'options' => array(
                    'blog-title' => array(
                        'type' => 'typography',
                        'selector' => '.entry-title',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 42,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-single-post-title' => array(
                'panel' => 'typography',
                'title' => __('Single Post Title', 'wpzoom'),
                'options' => array(
                    'post-title' => array(
                        'type' => 'typography',
                        'selector' => '.single h1.entry-title',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 42,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-single-post-title-image' => array(
                'panel' => 'typography',
                'title' => __('Single Post Title (with Featured Image)', 'wpzoom'),
                'options' => array(
                    'post-title-image' => array(
                        'type' => 'typography',
                        'selector' => '.single .has-post-cover .entry-header .entry-title',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 45,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),

            'font-page-title' => array(
                'panel' => 'typography',
                'title' => __('Single Page Title', 'wpzoom'),
                'options' => array(
                    'page-title' => array(
                        'type' => 'typography',
                        'selector' => '.page h1.entry-title',
                        'rules' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => 26,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'uppercase'
                        )
                    )
                )
            ),
            'font-page-title-image' => array(
                'panel' => 'typography',
                'title' => __('Single Page Title  (with Featured Image)', 'wpzoom'),
                'options' => array(
                    'page-title-image' => array(
                        'type' => 'typography',
                        'selector' => '.page .has-post-cover .entry-header h1.entry-title',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 45,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),

            'font-portfolio-title' => array(
                'panel' => 'typography',
                'title' => __('Portfolio Post Title (in Galleries)', 'wpzoom'),
                'options' => array(
                    'portfolio-title' => array(
                        'type' => 'typography',
                        'selector' => '.entry-thumbnail-popover-content h3',
                        'rules' => array(
                            'font-family' => 'Libre Franklin',
                            'font-size' => 26,
                            'font-weight' => 'bold',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'footer-area' => array(
                'title' => __('Footer', 'wpzoom'),
                'options' => array(
                    'footer-widget-areas' => array(
                        'setting' => array(
                            'default' => '3',
                            'sanitize_callback' => 'sanitize_text_field',
                            'transport' => 'refresh'
                        ),
                        'control' => array(
                            'type' => 'select',
                            'label' => __('Number of Widget Areas', 'wpzoom'),
                            'choices' => array( '0', '1', '2', '3', '4' ),
                        )
                    ),
                    'blogcopyright' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogcopyright', sprintf( __( 'Copyright &copy; %1$s &mdash; %2$s. All Rights Reserved', 'wpzoom' ), date( 'Y' ), get_bloginfo( 'name' ) )),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Footer Text', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 10
                        ),
                        'partial' => array(
                            'selector' => '.site-info .copyright',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogcopyright'
                        )

                    )
                )
            )
        );

        zoom_customizer_normalize_options($data);
    }


    return $data;
}

add_filter('wpzoom_customizer_data', 'inspiro_customizer_data');