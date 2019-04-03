<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Be_Page
 */

get_header();
?>
<?php
	/**
	* Hook - be_page_page_wrp_before.
	*
	* @hooked be_page_page_wrp_before - 10
	*/
	do_action( 'be_page_page_wrp_before', get_theme_mod( 'blog_layout_options', 'sidebar-right' ) );
?>
<main id="main" class="site-main">

	<?php
    while ( have_posts() ) :
    the_post();
    
   		 get_template_part( 'template-parts/content', 'single' );
    
    
    endwhile; // End of the loop.
    ?>
</main><!-- #main -->
<?php
	/**
	* Hook - be_page_page_wrp_after.
	*
	* @hooked be_page_page_wrp_after - 50
	* @hooked be_page_page_footer - 80
	
	*/
	do_action( 'be_page_page_wrp_after', get_theme_mod( 'blog_layout_options', 'sidebar-right' ) );
?>
<?php

get_footer();
