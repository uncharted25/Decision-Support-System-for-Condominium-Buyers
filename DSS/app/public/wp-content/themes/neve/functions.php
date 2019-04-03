<?php
/**
 * Neve functions.php file
 *
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      17/08/2018
 *
 * @package Neve
 */

define( 'NEVE_VERSION', '2.2.0' );
define( 'NEVE_INC_DIR', trailingslashit( get_template_directory() ) . 'inc/' );
define( 'NEVE_ASSETS_URL', trailingslashit( get_template_directory_uri() ) . 'assets/' );

if ( ! defined( 'NEVE_DEBUG' ) ) {
	define( 'NEVE_DEBUG', false );
}

/**
 * Themeisle SDK filter.
 *
 * @param array $products products array.
 *
 * @return array
 */
function neve_filter_sdk( $products ) {
	$products[] = get_template_directory() . '/style.css';

	return $products;
}

add_filter( 'themeisle_sdk_products', 'neve_filter_sdk' );

add_filter( 'themeisle_onboarding_phprequired_text', 'neve_get_php_notice_text' );

/**
 * Get php version notice text.
 *
 * @return string
 */
function neve_get_php_notice_text() {
	$message = sprintf(
		/* translators: %s message to upgrade PHP to the latest version */
		__( "Hey, we've noticed that you're running an outdated version of PHP which is no longer supported. Make sure your site is fast and secure, by %s. Neve's minimal requirement is PHP 5.4.0.", 'neve' ),
		sprintf(
			/* translators: %s message to upgrade PHP to the latest version */
			'<a href="https://wordpress.org/support/upgrade-php/">%s</a>',
			__( 'upgrading PHP to the latest version', 'neve' )
		)
	);

	return wp_kses_post( $message );
}

/**
 * Adds notice for PHP < 5.3.29 hosts.
 */
function neve_php_support() {
	printf( '<div class="error"><p>%1$s</p></div>', neve_get_php_notice_text() );
}

if ( version_compare( PHP_VERSION, '5.3.29' ) < 0 ) {
	/**
	 * Add notice for PHP upgrade.
	 */
	add_filter( 'template_include', '__return_null', 99 );
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'neve_php_support' );

	return;
}

require_once 'start.php';

require_once 'globals/utilities.php';
require_once 'globals/hooks.php';
require_once 'globals/sanitize-functions.php';

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
function wp_api_encode_acf($data,$post,$context){
    $customMeta = (array) get_fields($post['ID']);
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}
function wp_api_encode_acf_taxonomy($data,$post){
    $customMeta = (array) get_fields($post->taxonomy."_". $post->term_id );
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}
function wp_api_encode_acf_user($data,$post){
    $customMeta = (array) get_fields("user_". $data['ID']);
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}
add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_page', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_attachment', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_term', 'wp_api_encode_acf_taxonomy', 10, 2);
add_filter('json_prepare_user', 'wp_api_encode_acf_user', 10, 2);
function json_api_add_acf(&$post) 
{
    $post->acf = get_fields($post->id);
}

// get img src to JSON
add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
function add_thumbnail_to_JSON() {
//Add featured image
register_rest_field( 
    ['condominium', 'post'], // Where to add the field (Here, blog posts. Could be an array)
    'featured_image_src', // Name of new field (You can call this anything)
    array(
        'get_callback'    => 'get_image_src',
        'update_callback' => null,
        'schema'          => null,
         )
	);
}
function get_image_src( $object, $field_name, $request ) {
  $feat_img_array = wp_get_attachment_image_src(
    $object['featured_media'], // Image attachment ID
    'full',  // Size.  Ex. "thumbnail", "large", "full", etc..
    true // Whether the image should be treated as an icon.
  );
  return $feat_img_array[0];
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_js' );
	// Enqueue if pages... 
function enqueue_custom_js() {
	if(is_front_page()) {
		wp_enqueue_script('condo_js_jquery', get_template_directory_uri().'/../neve-child/javascript/condo-list.js', '1.0', 1 );
		
	}
}
function abc_load_my_scripts() {
  //wp_enqueue_script( 'boot1','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array('jquery'));
  wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'));
  wp_enqueue_script( 'boot2','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'abc_load_my_scripts', 999);

