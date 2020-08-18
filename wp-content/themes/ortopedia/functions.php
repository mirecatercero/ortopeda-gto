<?php
require get_template_directory() . '/inc/database.php';
require get_template_directory() . '/inc/reservaciones.php';
require get_template_directory() . '/inc/opciones.php';

function ortopedia_gto_setup(){
  add_theme_support('post-thumbnails');

	add_image_size('nosotros', 437, 291, true);
	add_image_size('articulos', 768, 515, true);
	add_image_size('articulos_portrait',435 , 526, true);

	update_option('thumbnail_size_w', 253);
	update_option('thumbnail_size_h', 164);

}
add_action('after_setup_theme', 'ortopedia_gto_setup');


function ortopedia_gto_styles(){

  //registrar estilos
  wp_register_style('normalize' , get_template_directory_uri() . '/css/normalize.css' , array('bootstrap') , '8.0.0');
	wp_register_style('google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0');
	wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', array(), '4.2.1');
	wp_register_style('fontawesome' , get_template_directory_uri() . '/css/font-awesome.min.css' , array() , '4.7.0');
	wp_register_style('fluidbox-css' , get_template_directory_uri() . '/css/fluidbox.min.css' , array() , '4.7.0');
  wp_register_style('style' , get_template_directory_uri() . '/style.css' , array('normalize') , '1.0');

  //llamar a l os estilos
  wp_enqueue_style('normalize');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('fluidbox-css');
  wp_enqueue_style('style');

	//Registrar JS
	$apikey = esc_html(get_option('ortopedia_gmap_apikey'));
	wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?key='.$apikey.'&callback=initMap',array(), '', true );

	wp_register_script('bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', array('jquery'), '1.14.6', true);
	wp_register_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', array('jquery'), '4.2.1', true);

  wp_register_script('fluidbox-js', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array(), '1.0.0', true);
	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);

	wp_enqueue_script('maps');
	wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap-popper');
	wp_enqueue_script('bootstrap-js');
	wp_enqueue_script('fluidbox-js');
	wp_enqueue_script('scripts');

	//pasar variables de php a javascript.
	wp_localize_script(
		'scripts',
		'opciones',
		array(
			'latitud' => get_option('ortopedia_gmap_latitud'),
			'longitud' => get_option('ortopedia_gmap_longitud'),
			'zoom' => get_option('ortopedia_gmap_zoom')
		)
	);
}

add_action('wp_enqueue_scripts' , 'ortopedia_gto_styles');

//agregar async y defer

function agregar_async_defer($tag, $handle){
	if ('maps' !== $handle )
		return $tag;
	return str_replace('src', 'async="async" defer="defer" src', $tag);

}
add_filter('script_loader_tag', 'agregar_async_defer',10, 2);



//Creación de menus
function ortopedia_gto_menus(){
  register_nav_menus(array(
    'header-menu' => __('Header Menu' , 'ortopedia_gto'),
    'social-menu' => __('Social Menu' , 'ortopedia_gto')
  ));
}

add_action('init' , 'ortopedia_gto_menus');


add_action( 'init', 'ortopedia_aparatos' );

function ortopedia_aparatos() {
	$labels = array(
		'name'               => _x( 'articulos', 'ortopedia' ),
		'singular_name'      => _x( 'articulos', 'post type singular name', 'ortopedia' ),
		'menu_name'          => _x( 'articulos', 'admin menu', 'ortopedia' ),
		'name_admin_bar'     => _x( 'articulos', 'add new on admin bar', 'ortopedia' ),
		'add_new'            => _x( 'Add New', 'book', 'ortopedia' ),
		'add_new_item'       => __( 'Add New articulo', 'ortopedia' ),
		'new_item'           => __( 'New articulos', 'ortopedia' ),
		'edit_item'          => __( 'Edit articulos', 'ortopedia' ),
		'view_item'          => __( 'View articulos', 'ortopedia' ),
		'all_items'          => __( 'All articulos', 'ortopedia' ),
		'search_items'       => __( 'Search articulos', 'ortopedia' ),
		'parent_item_colon'  => __( 'Parent articulos:', 'ortopedia' ),
		'not_found'          => __( 'No articulos found.', 'ortopedia' ),
		'not_found_in_trash' => __( 'No articulos found in Trash.', 'ortopedia' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'ortopedia' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'aparatos' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category' ),
	);

	register_post_type( 'aparatos', $args );
}


//codigo WIDGETS

function ortopedia_widgets(){
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}

add_action('widgets_init', 'ortopedia_widgets');
