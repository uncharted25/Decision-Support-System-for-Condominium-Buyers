<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
	do_action( 'be_page_page_wrp_before', get_theme_mod( 'page_layout_options', 'sidebar-right' ) );
?>
    <main id="main" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

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
	do_action( 'be_page_page_wrp_after', get_theme_mod( 'page_layout_options', 'sidebar-right' ) );
?>
<?php

get_footer();
