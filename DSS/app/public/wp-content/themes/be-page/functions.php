<?php
/**
 * Be Page functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Be_Page
 */

/**
 * Implement the Theme Core Function.
 */
require get_template_directory() . '/inc/theme-core.php';

/**
 * Implement the Theme Layout Function.
 */
require get_template_directory() . '/inc/theme-layout-function.php';


/**
 * Implement All Posts Page Hook	.
 */
require get_template_directory() . '/inc/posts-hooks.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
* Embed kirki .
*/
require get_template_directory() . '/vendors/kirki/kirki.php';

/**
* kirki Configuration .
*/
require get_template_directory() . '/inc/kirki-configuration.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
* TGM .
*/
require get_template_directory() . '/inc/tgm/recommend-plugins.php';


/**
* PRO .
*/
require get_template_directory() . '/inc/pro/admin-page.php';


/**
* Customizer .
*/
require get_template_directory() . '/inc/customizer/customizer.php';


/**
* Widget Helper .
*/
require_once get_template_directory() . '/vendors/widgets-helper/class-widget-helper.php';

/**
* Theme Widgets .
*/
require_once get_template_directory() . '/inc/widgets.php';
