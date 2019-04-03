<?php
/**
 * Posts hook & function
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Be_Page
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! function_exists( 'be_page_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function be_page_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
			$type =  get_theme_mod( 'blog_content_type', 'excerpt' ) ;

		?>
          
            
		<?php if ( is_singular() ) :?>
        <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
        <?php else: ?>
        	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
        <?php endif;?>
        	<?php if( $type == 'excerpt' || is_search()  )  : ?>
            <figure style="background:url(<?php echo esc_url( $post_thumbnail_url );?>) no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;"> </figure>
            <?php else: ?>
             <?php the_post_thumbnail('full');?>
            <?php endif; ?>
        </a>
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'be_page_posts_formats_thumbnail', 'be_page_posts_formats_thumbnail' );


if ( ! function_exists( 'be_page_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function be_page_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
			// If not a single post, highlight the video file.
			$post_thumbnail_url = '';
			if ( has_post_thumbnail() ) :
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			endif;
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<figure style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;" class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</figure>';
				}
			else: 
				do_action('be_page_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'be_page_posts_formats_video', 'be_page_posts_formats_video' ); 


if ( ! function_exists( 'be_page_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function be_page_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
		
		
			$post_thumbnail_url = '';
			if ( has_post_thumbnail() ) :
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			endif;
			
			
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo '<figure style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;" class="entry-video embed-responsive embed-responsive-16by9"><div class="audio-center">';
						echo $audio_html;
					echo '</div></figure>';
					
			}
		else: 
			do_action('be_page_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'be_page_posts_formats_audio', 'be_page_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'be_page_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function be_page_posts_formats_gallery() {
		global $post;
		$post_thumbnail_url = '';
			if ( has_post_thumbnail() ) :
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			endif;
		if ( get_post_gallery() ) :
			echo '<figure style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;" class="gallery-media owlGallery">';
			
				$gallery = get_post_gallery( $post, false );
				$ids = explode( ",", $gallery['ids'] );
				
				foreach( $ids as $id ) {
				
				   $link   = wp_get_attachment_url( $id );
				
				  echo '<div class="item"><img src="' . esc_url( $link ) . '"  class="img-responsive" alt="' .esc_attr( the_title_attribute() ). '" title="' .esc_attr( get_the_title() ). '"  /></div>';
				
				} 
				
			echo '</figure>';
			
		else: 
			do_action('be_page_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'be_page_posts_formats_gallery', 'be_page_posts_formats_gallery' ); 




if ( ! function_exists( 'be_page_posts_blog_media' ) ) :

	/**
	 * Post be_page_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function be_page_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('be_page_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('be_page_posts_formats_gallery');
			break;
			case 'audio':
				do_action('be_page_posts_formats_audio');
			break;
			case 'video':
				do_action('be_page_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'be_page_posts_blog_media', 'be_page_posts_blog_media' ); 

if ( ! function_exists( 'be_page_short_excerpt' ) ) :

	/**
	 * Filter the except length to 20 words.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	function be_page_short_excerpt( $length ){
        if ( is_admin() ) {
            return $length;
        }

        return absint( get_theme_mod( 'excerpt_length', 160 ) );
    }
    add_filter( 'excerpt_length', 'be_page_short_excerpt', 999 );
endif;


if ( ! function_exists( 'be_page_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function be_page_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'be-page' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo ' <div class="post-info">
          <h6>';
		  
		echo '<span class="posted-on"><i class="fa fa-clock-o" aria-hidden="true"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
		
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'be-page' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'in %1$s', 'be-page' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			
		if( get_theme_mod( 'blog_content_type', 'excerpt' ) == 'content' )  :
		
		printf( ' %1$s <a href="%2$s" class="avatar_round">%3$s</a>',  esc_html__( 'by ', 'be-page' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),  esc_html( get_the_author() ) ); 
		
		endif;
		
		
		echo '</h6>
        </div>';

	}
endif; 

if ( ! function_exists( 'be_page_posted_author' ) ) :
	/**
	 * Prints author link for excerpt type content.
	 */
	function be_page_posted_author() {
		
		printf( '<div class="post-author"><a href="%1$s" class="avatar_round">%2$s</a></div>',  esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_avatar( get_the_author_meta('user_email'), $size = '40') . esc_html__( 'by ', 'be-page' ). esc_html( get_the_author() ) ); 
		
	}
endif;



if ( ! function_exists( 'be_page_single_posts_get_author' ) ) :
/**
	 * Prints author link for single page  content.
	 */
function be_page_single_posts_get_author( $post_id = 0 ){
     $post = get_post( $post_id );
    if( $post->post_author != "" ){
	
	 printf( '<div class="post-author"><a href="%1$s" class="avatar_round">%2$s</a></div>',  esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ), get_avatar( get_the_author_meta( 'user_email', $post->post_author ), $size = '40') . esc_html__( 'by ', 'be-page' ). get_the_author_meta( 'display_name', $post->post_author ) ); 
	}
}
endif;

if ( ! function_exists( 'be_page_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function be_page_walker_comment($comment, $args, $depth) {
		?>
        <li>
            <div class="comment">
              <div class="comment-pic">
                 <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 70 ); ?>
              </div>
              <div class="comment-text">
                <h5 class="upper"><?php echo get_comment_author_link();?></h5><span class="comment-date">
				<?php
               		 /* translators: 1: date, 2: time */
                	printf( esc_html__('Posted on %1$s at %2$s', 'be-page' ), get_comment_date(),  get_comment_time() );
                ?>
                <?php 
					$args ['reply_text'] =  esc_html__( 'Reply', 'be-page' );
                    comment_reply_link( array_merge( $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </span>
                <p><?php comment_text(); ?></p>
              </div>
            </div>
        </li>
            
		<?php
	}
	

endif;

if ( ! function_exists( 'be_page_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function be_page_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'be-page' ) );
			if ( $tags_list ) {
				echo $tags_list;
			}
			
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'be-page' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link pull-right">',
			'</span>'
		);
	}
endif;
