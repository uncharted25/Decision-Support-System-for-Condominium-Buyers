<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Be_Page
 */

get_header();
?>

<section class="height-100 dark-bg last-section">

<div class="centrize">
  <div class="v-center">
    <div class="container">
      <div class="error-page">
        <div class="title">
          <h1 class="colored-text"><?php esc_html_e( '404', 'be-page' );?></h1>
          <h2><?php esc_html_e( 'Oh no! There was an error.', 'be-page' );?></h2>
          <h4><?php esc_html_e( 'We couldn\'t find the page you were looking for.', 'be-page' );?></h4>
        </div><a class="btn btn-color" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home', 'be-page' ); ?></a>
      </div>
    </div>
  </div>
</div>
</section>

	<!-- #primary -->

<?php
if( function_exists('be_page_page_footer') ) { be_page_page_footer(); }
get_footer(); 
