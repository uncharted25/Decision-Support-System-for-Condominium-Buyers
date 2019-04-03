<?php 

/**
 * be_page Theme Customizer.
 *
 * @package be_page
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function be_page_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/core/control.php';

	

	
	// Register custom section types.
	$wp_customize->register_section_type( 'be_page_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new be_page_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Be Page ', 'be-page' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'be-page' ),
				'pro_url'  => 'https://edatastyle.com/product/be-page-pro/',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'be_page_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */

function be_page_customizer_css() {
	
	wp_enqueue_script( 'be_page_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-admin.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'be_page_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-controll.css' );
	
}
add_action( 'customize_controls_enqueue_scripts', 'be_page_customizer_css',0 );


