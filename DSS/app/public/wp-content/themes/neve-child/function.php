<?php 


add_action( 'wp_enqueue_scripts', 'enqueue_custom_js' );
	// Enqueue if pages... 
function enqueue_custom_js() {
	if(is_front_page()) {
		wp_enqueue_script('condo_js_jquery', get_template_directory_uri().'/../neve-child/javascript/condo-list.js', '1.0', 1 );
		
	}
}
function abc_load_my_scripts() {
  wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.3.1.slim.min.js', array('jquery'));
  wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'));
  wp_enqueue_script( 'boot2','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'abc_load_my_scripts', 999);

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
