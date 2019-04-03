<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
	do_action( 'be_page_page_wrp_before', get_theme_mod( 'blog_layout_options', 'sidebar-right' ) );
?>
	<div class="blog-articles">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			$i = 0;
			while ( have_posts() ) : $i++;  set_query_var( 'i', $i );
				
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

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
?>
<?php

get_footer();
