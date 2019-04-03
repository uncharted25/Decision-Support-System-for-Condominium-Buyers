<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Be_Page
 */


$align = ($i % 2 == 0) ? 'image-right' : '';
$type =  get_theme_mod( 'blog_content_type', 'excerpt' ) ;
if( $type == 'excerpt' )  :

$media = get_media_embedded_in_content( get_the_content(), array( 'audio', 'video', 'object', 'embed', 'iframe' ) );
$class = ( !has_post_thumbnail() && !get_post_gallery() && $media == "" ) ? 'full-row' : '';
$embedded = get_media_embedded_in_content( get_the_content(), array( 'video', 'object', 'embed', 'iframe','audio' ) );
$content_fluid = 'fluid';
?>

<article data-animation="fadeInUp" id="post-<?php the_ID(); ?>" <?php post_class(array('side-post',$align, $class )); ?>>
   <?php 
   if ( has_post_thumbnail() || ! empty( $embedded ) || get_post_gallery() ) :
   $content_fluid = ''; 
   ?>
  <div class="side-post-image odd_even_layout">
    <?php do_action('be_page_posts_blog_media');?>
  </div>
  <?php endif; ?>
  <div class="side-post-content <?php echo esc_attr( $content_fluid );?>">
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
      <?php be_page_posted_author();?>
    </div>
  </div>
  <div class="clearfix"></div>
</article>
<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'card-post' )); ?>>
  <div class="card-post-wrapper">
    <div class="card-post-image">
      <?php do_action('be_page_posts_formats_thumbnail');?>
    </div>
    <div class="card-post-content">
      <div class="post-body">
        <h3>
          <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>
        </h3>
        <?php 
         the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'be-page' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );
            ?>
            <div class="clearfix"></div>
      </div>
      <div class="post-footer">
        <?php be_page_posted_on(); ?>
      </div>
    </div>
  </div>
</article>
<?php endif;?>
<!-- #post-<?php the_ID(); ?> --> 
