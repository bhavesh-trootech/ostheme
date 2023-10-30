<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri().'/css/slick.css', array(), (string) time(), '' );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri().'/css/slick-theme.css', array(), (string) time(), '' );	

	// wp_enqueue_script( 'jquery-link', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), (string) time(), true );
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri().'/js/slick.js?rand='.rand(1,100), array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array(), (string) time(), true );
	wp_enqueue_style( 'customcss', get_stylesheet_directory_uri() . '/css/custom.css', array(), '0.1', 'all' );
	wp_enqueue_style( 'devcss', get_stylesheet_directory_uri() . '/css/devcustom.css', array(), (string) time(), 'all' );

	wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom-script.js', array('jquery'), (string) time(), true);
  wp_localize_script('custom-script', 'custom_vars', array(
        'custom_nonce' => wp_create_nonce('custom-nonce'),
        'custom_ajax_url' => admin_url('admin-ajax.php'),
  ));
  /****/
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
/****/
require get_stylesheet_directory() . '/inc/post-types.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/ajax-functions.php';

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
  }
  add_action( 'admin_head', 'fix_svg' );
/****/
/**Make search post custom **/
function register_search_post_widget( $widgets_manager ) {

    require get_stylesheet_directory() . '/widgets/search-post-custom.php';
    $widgets_manager->register( new \Elementor_List_Widget() );

}
add_action( 'elementor/widgets/register', 'register_search_post_widget' );