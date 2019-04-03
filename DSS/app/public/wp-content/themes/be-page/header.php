<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Be_Page
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" style="overflow:hidden;">

<?php
	/**
	* Hook - be-page_header_container.
	*
	* @hooked be_page_header_navbar - 10
	* @hooked be_page_header_page_title - 20
	*/
	do_action( 'be_page_header_layout' );
?>