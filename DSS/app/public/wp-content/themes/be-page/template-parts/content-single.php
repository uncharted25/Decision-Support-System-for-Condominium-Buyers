<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Be_Page
 */

?>

<article data-animation="fadeInUp" id="post-<?php the_ID(); ?>" <?php post_class( array( 'post-single' ) ); ?>>

    <div class="post-body entry-content">
        <?php the_content();?>  
    </div>

<div class="row">
    <div class="post-tags col-md-6">
    	<?php be_page_entry_footer();?>
    </div>
    <div class="single-prev-next col-md-6 pull-right">
        <?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> '.__('Prev Article','be-page')); ?>
        <?php next_post_link('%link', __('Next Article','be-page').' <i class="fa fa-long-arrow-right"></i>'); ?>
    </div>
</div>
<div class="clearfix" style="clear:both;"></div>
	
</article><!-- #post-<?php the_ID(); ?> -->
