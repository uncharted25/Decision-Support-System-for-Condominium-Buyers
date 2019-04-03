<?php
/**
* Be Page Theme Customizer
*
* @package Be_Page
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/*-----------------------------------------
* HEADER
*----------------------------------------*/


if ( ! function_exists( 'be_page_header_navbar' ) ) :
	/**
	 * Sets up theme defaults header Navigation bar , logo, soical icon etc.
	 *
	 */
	function be_page_header_navbar() {
	?>
        <nav id="navbar">
        <div class="navbar-wrapper">
          <div class="container">
            <div class="logo">
                
                <?php if( function_exists( 'the_custom_logo' ) && get_custom_logo() != "" ):
                    the_custom_logo();
                else: ?> 
                	 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <h4><?php bloginfo( 'name' ); ?></h4>
                    <div class="subtitle"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></div>
                   </a>  
                <?php endif;?>
               
                
            </div>
            <div class="menu-extras">
              <?php if ( true == get_theme_mod( 'right_social_profile', true ) ) : ?>
              <div class="menu-item">
                <div class="header-socials">
                  <ul>
					<?php if( get_theme_mod( 'facebook_link' ) != "" ):?>
                        <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'facebook_link' ) );?>"><i class="fa fa-facebook"></i> </a></li>
					<?php endif;?>
					<?php if( get_theme_mod( 'twitter_link' ) != "" ):?>
                    	<li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'twitter_link' ) );?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <?php endif;?>
                    <?php if( get_theme_mod( 'pinterest_link' ) != "" ):?>
                    	<li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'pinterest_link' ) );?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    <?php endif;?>
                    <?php if( get_theme_mod( 'linkedin_link' ) != "" ):?>
                     	<li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'linkedin_link' ) );?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                    <?php endif;?>
                  </ul>
                </div>
              </div>
              <?php endif; ?>
              <div class="menu-item">
                <div class="nav-toggle">
                  <a class="menu-toggle" href="javascript:void(0)">
                    <div class="hamburger">
                      <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <div id="navigation">
              <ul class="navigation-menu nav">
				<?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container' 	 => '',
                            'items_wrap' => '%3$s'
                        )
                    );
                ?>
              </ul>
            </div>
          </div>
        </div>
        </nav>
    <?php	
	}
	add_action('be_page_header_layout','be_page_header_navbar',10);
endif;

if ( ! function_exists( 'be_page_header_page_title' ) ) :
	/**
	 * Sets up theme defaults header Page title, Feature Image etc.
	 *
	 */
	function be_page_header_page_title() {
		if ( is_404() ) { return false; }
		
	if ( is_front_page() && is_active_sidebar('front_page_sidebar')){
		echo '<section class="slider-widgets">';
		dynamic_sidebar( 'front_page_sidebar' );
		echo '</section>';
		
	}else if ( is_home() && is_active_sidebar('blog_page_sidebar')){
		echo '<section class="slider-widgets">';
		dynamic_sidebar( 'blog_page_sidebar' );
		echo '</section>';
	}else{
	
	

	?>
    
        <section class="page-title parallax-section">
        
        <div class="row-parallax-bg">
          <div class="parallax-wrapper">
            <div class="parallax-bg">
            	
              <?php if ( has_post_thumbnail() ) :
			  	$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			   ?>
               <img src="<?php echo esc_url( $post_thumbnail_url );?>" alt="<?php echo esc_attr( the_title_attribute() );?>">
              <?php else:
			  	$header_image = get_header_image();
			   ?>
               <img src=" <?php echo esc_url( $header_image );?>" alt="<?php echo esc_attr( the_title_attribute() );?>">
              <?php endif;?>
             
            </div>
          </div>
          <div class="parallax-overlay"></div>
        </div>
        
        <div class="centrize">
          <div class="v-center">
            <div class="container">
              <div class="single-post-info">
                <?php 
				if( get_theme_mod( 'hero_description' ) != ""  && is_home() ):
					echo esc_html( get_theme_mod( 'hero_description' ) );
				endif;
				if( is_singular('post') ) :
					be_page_posted_on();
				endif;
				?>
                <div class="title text-center">
					<?php
						if ( is_home() ) {
							echo '<h1 class="display-1">';
							if( get_theme_mod( 'heading_text' ) != "" ):
								echo esc_html( get_theme_mod( 'heading_text' ) );
							else:
								echo bloginfo( 'name' );
							endif;
							echo '</h1>';
						} elseif ( is_singular() ) {
							
							echo '<h1 class="display-1">';
								echo single_post_title( '', false );
							echo '</h1>';
							
							
						}else if ( function_exists('is_shop') && is_shop() ){
							if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
								echo '<h1>';
								echo esc_html( woocommerce_page_title() );
								echo '</h1>';
							}
						}else if( function_exists('is_product_category') && is_product_category() ){
							echo '<h1 class="page-title-text">';
								echo esc_html( woocommerce_page_title() );
							echo '</h1>';
							echo '<p class="subtitle">';
								do_action( 'woocommerce_archive_description' );
							echo '</p>';
						
						} elseif ( is_archive() ) {
							 the_archive_title( '<h1 class="display-1">', '</h1>' );
							 the_archive_description( '<h4 class="upper">', '</h4>' );
							 
						} elseif ( is_search() ) {
							 echo '<h1 class="title">';
							 printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'be-page' ),  get_search_query() );
							 echo '</h1>';
						} elseif ( is_404() ) {
							echo '<h1 class="display-1">';
								esc_html_e( '404 Error', 'be-page' );
							echo '</h1>';
						}
						do_action( 'be_page_more_element_add' );
                    ?>
                </div>
             
                 <?php  
				  if( is_singular('post') ) :   
				  	be_page_single_posts_get_author( get_the_ID() );
				  endif; 
				 ?>
              	
              </div>
            </div>
          </div>
        </div>
        </section>
        
    <?php	
			
		}
	}
	add_action('be_page_header_layout','be_page_header_page_title',20);
endif;






/*-----------------------------------------
	* Base Container
*----------------------------------------*/


if ( ! function_exists( 'be_page_page_wrp_before' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_wrp_before() {
		$bg_color = get_background_color() != "" ? 'background-color:#'. get_background_color().';' : '';
		$bg_img = get_background_image() != "" ? 'background-image:url('. get_background_image() .');' : '';
	?>
    <section class="<?php echo is_singular('post') ? 'last-section':'';?>" style=" <?php echo esc_attr( $bg_color ). esc_attr( $bg_img );?>">
    	<div class="container">
    		<div class="row">  
        
    <?php	
	}
	add_action('be_page_page_wrp_before','be_page_page_wrp_before',10);
endif;


if ( ! function_exists( 'be_page_page_container_before' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_container_column_before( $align = '' ) {
		$container_position = ( $align == 'sidebar-left' ) ? 'container-pull-right pull-right' : '';
	?>
    	<div id="primary" class="content-area col-md-9 <?php echo esc_attr( $container_position ); ?> ">
    <?php	
	}
	add_action('be_page_page_wrp_before','be_page_page_container_column_before',20,1);
endif;




if ( ! function_exists( 'be_page_page_container_column_after' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_container_column_after() {
	?>
    	</div>
    <?php	
	}
	add_action('be_page_page_wrp_after','be_page_page_container_column_after',10);
endif;


if ( ! function_exists( 'be_page_page_sidebar' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_sidebar( $align = '' ) {
		$sidebar_position = ( $align == 'sidebar-left' ) ? 'pull-left' : '';
	?>
    <div class="col-md-3 pull-left <?php echo esc_attr( $sidebar_position ); ?>">	
    	<?php get_sidebar(); ?>
    </div>
    <?php  
	}
	add_action('be_page_page_wrp_after','be_page_page_sidebar',20,1);
endif;



if ( ! function_exists( 'be_page_page_wrp_after' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_wrp_after() {
	?>
    		</div>
    	</div>
    </section>
    <?php	
	}
	add_action('be_page_page_wrp_after','be_page_page_wrp_after',50);
endif;



if ( ! function_exists( 'be_page_single_posts_comments' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_single_posts_comments() {
		if( is_singular('post') ) :
	?>
    <section class="last-section grey-bg">
        <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
					<?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
            	</div>
            </div>
        </div>
    </section>
    <?php	
		endif;
	}
	add_action('be_page_page_wrp_after','be_page_single_posts_comments',60);
endif;

if ( ! function_exists( 'be_page_page_footer' ) ) :
	/*
	* @since 1.0.0
	*/
	function be_page_page_footer() {
	?>
<footer id="footer">

<?php if ( is_active_sidebar( 'footer' ) ) { ?>
<div class="footer-widgets">
  <div class="container">
    <div class="row">
      <?php dynamic_sidebar( 'footer' ); ?>
    </div>
  </div>
</div>
<?php } ?>

<div class="footer-copy">
  <div class="container">
    <div class="row">
       <?php if ( true == get_theme_mod( 'footer_social_profile', true ) ) : ?>	
      <div class="col-sm-6">
        <ul class="social-list">
        
			<?php if( get_theme_mod( 'facebook_link' ) != "" ):?>
                <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'facebook_link' ) );?>"><i class="fa fa-facebook"></i> </a></li>
            <?php endif;?>
            <?php if( get_theme_mod( 'twitter_link' ) != "" ):?>
                <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'twitter_link' ) );?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <?php endif;?>
            <?php if( get_theme_mod( 'pinterest_link' ) != "" ):?>
                <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'pinterest_link' ) );?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            <?php endif;?>
            <?php if( get_theme_mod( 'linkedin_link' ) != "" ):?>
                <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'linkedin_link' ) );?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
            <?php endif;?>
        </ul>
      </div>
      <?php endif; ?>
      <div class="col-sm-6 pull-right">
        <div class="copy-text">
           <?php
		/* translators: 1: Current Year, 2: Blog Name 3: Theme Developer 4: WordPress. */
		printf( esc_html__( 'Copyright %1$s %2$s All Right Reserved. Theme By %3$s . Proudly powered by %4$s', 'be-page' ), esc_attr( date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ), '<a href="https://edatastyle.com/product/be-page/">eDataStyle</a>', '<a href="https://wordpress.org">WordPress</a>' );
	?>
        </div>
      </div>
    </div>
  </div>
</div>
</footer>
<a href="javascript:void(0)" id="backToTop" class="ui-to-top active"> <?php echo esc_html__( 'BACK TO TOP', 'be-page' );?><i class="fa fa-long-arrow-up " aria-hidden="true"></i></a>
    <?php	
	}
	add_action('be_page_page_wrp_after','be_page_page_footer',80);
endif;


add_action( 'wp_head', 'be_page_move_theme_down' );
function be_page_move_theme_down() {
  if ( is_admin_bar_showing() ) {
    ?>
    <style type="text/css">
   		#navbar{ top:30px;}
    </style>
    <?php
  }
}

