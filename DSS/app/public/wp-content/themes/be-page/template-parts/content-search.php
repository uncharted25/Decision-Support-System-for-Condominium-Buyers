<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Be_Page
 */
$class = ( !has_post_thumbnail() ) ? 'full-row' : '';
?>

<article data-animation="fadeInUp" id="post-<?php the_ID(); ?>" <?php post_class( array( 'side-post', $class ) ); ?>>
 
 <?php if ( has_post_thumbnail() ) : ?>
  <div class="side-post-image ">
  	<?php if( 'post' === get_post_type() ) :?>
    <div class="post-category"><a href="#">Lifestyle</a></div>
    <?php endif; ?>
    <?php do_action('be_page_posts_blog_media');?>
  </div>
  <?php endif; ?>
  
  <div class="side-post-content">
    <div class="post-content-wrapper">
      <?php be_page_posted_on();?>
      <div class="post-title">
        <h4>
          <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>
        </h4>
      </div>
      <div class="post-body">
        <?php the_excerpt();?>
      </div>
      <?php if( 'post' === get_post_type() ) :?>
      <?php be_page_posted_author();?>
      <?php endif; ?>
    </div>
  </div>
  
  
  <div class="clearfix"></div>
</article>
<!-- #post-<?php the_ID(); ?> --> 
