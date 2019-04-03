<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
	<div class="blog-articles">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_pagination( array(
					'type' => 'list',
					'prev_text' => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
					'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
					'screen_reader_text' => esc_html__( '&nbsp;', 'be-page' ),
				) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
	/**
	* Hook - be_page_page_wrp_after.
	*
	* @hooked be_page_page_wrp_after - 50
	* @hooked be_page_page_footer - 80
	
	*/
	do_action( 'be_page_page_wrp_after', get_theme_mod( 'blog_layout_options', 'sidebar-right' ) );


get_footer();
