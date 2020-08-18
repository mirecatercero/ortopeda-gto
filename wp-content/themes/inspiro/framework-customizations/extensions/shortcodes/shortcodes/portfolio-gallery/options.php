<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_url           = admin_url();

$options = array(

    'category'     => array(
        'label'   => esc_html__( 'Display From', 'fw' ),
        'desc'    => esc_html__( 'Select a portfolio category', 'fw' ),
        'type'    => 'select',
        'value'   => '',
        'choices' => fw_get_category_term_list(),
    ),

    'posts_number' => array(
        'label' => esc_html__( 'No of Posts', 'fw' ),
        'desc'  => esc_html__( 'Enter the number of posts to display. Ex: 3, 6, 9', 'fw' ),
        'type'  => 'short-text',
        'value' => '6'
    ),

    'columns'     => array(
        'label'   => esc_html__( 'Number of Columns', 'fw' ),
        'desc'    => esc_html__( 'The number of columns may vary depending on user\'s screen size', 'fw' ),
        'type'    => 'select',
        'value'   => '3',
        'choices' => array(
            '3'  => __( '3', 'fw' ),
            '4' => __( '4', 'fw' ),
            '5' => __( '5', 'fw' ),
        )
    ),

    'masonry' => array(
        'type'  => 'switch',
        'label'   => __( 'Masonry Layout', 'fw' ),
        'desc' => __('Select if you want to display posts in masonry layout or not', 'fw'),
        'value' => 'masonry_hide',
        'right-choice' => array(
            'value' => 'masonry_show',
            'label' => __('Enable', 'fw'),
        ),
        'left-choice' => array(
            'value' => 'masonry_hide',
            'label' => __('Disable', 'fw'),
        ),
    ),

    'lightbox' => array(
        'type'  => 'switch',
        'label'   => __( 'Lightbox', 'fw' ),
        'desc' => __('Select if you want to display a lightbox for videos and images.', 'fw'),
        'value' => 'lightbox_disable',
        'right-choice' => array(
            'value' => 'lightbox_enable',
            'label' => __('Enable', 'fw'),
        ),
        'left-choice' => array(
            'value' => 'lightbox_disable',
            'label' => __('Disable', 'fw'),
        ),
    ),

    'excerpt' => array(
        'type'  => 'switch',
        'label'   => __( 'Post Excerpts', 'fw' ),
        'value' => 'excerpt_show',
        'right-choice' => array(
            'value' => 'excerpt_show',
            'label' => __('Show', 'fw'),
        ),
        'left-choice' => array(
            'value' => 'excerpt_hide',
            'label' => __('Hide', 'fw'),
        ),
    ),

    'button' => array(
        'type'  => 'switch',
        'label'   => __( 'Read More Button', 'fw' ),
        'value' => 'button_show',
        'right-choice' => array(
            'value' => 'button_show',
            'label' => __('Show', 'fw'),
        ),
        'left-choice' => array(
            'value' => 'button_hide',
            'label' => __('Hide', 'fw'),
        ),
    ),

    'button_label'  => array(
        'label' => '',
        'desc'  => __( 'Button Label', 'fw' ),
        'type'  => 'text',
        'value' => 'Read More'
    ),

    'button_all' => array(
        'type'  => 'switch',
        'label'   => __( 'View All Button', 'fw' ),
        'value' => 'button_all_show',
        'right-choice' => array(
            'value' => 'button_all_show',
            'label' => __('Show', 'fw'),
        ),
        'left-choice' => array(
            'value' => 'button_all_hide',
            'label' => __('Hide', 'fw'),
        ),
    ),

    'label'  => array(
        'label' => '',
        'desc'  => __( 'Button Label', 'fw' ),
        'type'  => 'text',
        'value' => 'View All'
    ),
    'link'   => array(
        'label' => '',
        'desc'  => __( 'Link', 'fw' ),
        'type'  => 'text',
        'value' => '#'
    ),
    'target' => array(
        'label' => '',
        'type'  => 'switch',
        'value' => '_self',
        'desc'    => __( 'Open Link in New Window', 'fw' ),
        'right-choice' => array(
            'value' => '_blank',
            'label' => __('Yes', 'fw'),
        ),
        'left-choice' => array(
            'value' => '_self',
            'label' => __('No', 'fw'),
        ),
    ),

);