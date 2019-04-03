<?php
/**
* Be Page Kirki Configuration
*
* @package Be_Page
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'be_page_widgets_init' ) ) :
	/**
	 * kirki live url .
	 */
	function be_page_kirki_configuration() {
		return array( 'url_path'     => get_stylesheet_directory_uri() . '/vendors/kirki/' );
	}
	add_filter( 'kirki/config', 'be_page_kirki_configuration' );

endif;

if ( class_exists( 'Kirki' ) ) :
/**
 * Class be_page_Kirki
 */
class be_page_Kirki_Options extends Kirki {
	
	/**
	* @var striang
	*/
	protected $panel;
	
	/**
	* @var striang
	*/
	protected $config_id;
	
	/**
	 * The single instance of the class
	 *
	 * @var ATA_WC_Variation_Swatches_Admin
	 */
	protected static $instance = null;

	/**
	 * Main instance
	 *
	 * @return ATA_WC_Variation_Swatches_Admin
	 */
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	/**
	 * Class constructor.
	 */
	public function __construct() {
			$this->panel ='be_page';
			$this->config_id ='be_page_config_id';
			
			$this->be_page_panel();
			$this->be_page_social_media();
			$this->be_page_blog_layout_options();
			$this->be_page_page_layout_options();
			
		
	}
	
	public function be_page_panel(){
		
			$this->add_panel( $this->panel, array(
				'priority'    => 30,
				'title'       => esc_attr__( 'Theme Options lite', 'be-page' ),
			) );
			
	}
	
	public function be_page_social_media(){
		
			$this->add_section( 'social_media', array(
				'title'          => esc_attr__( 'Social Profile Options', 'be-page' ),
				'panel'          => $this->panel,
				'priority'       => 100,
			) );
			  
			$this->add_field( $this->config_id, array(
				'type'        => 'checkbox',
				'settings'    => 'right_social_profile',
				'label'       => esc_attr__( 'Social Profile ( Nav Right )', 'be-page' ),
				'section'     => 'social_media',
				'default'     => true,
			) );
			
			$this->add_field( $this->config_id, array(
				'type'        => 'checkbox',
				'settings'    => 'footer_social_profile',
				'label'       => esc_attr__( 'Social Profile ( Footer Left )', 'be-page' ),
				'section'     => 'social_media',
				'default'     => true,
			) );
			
			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'facebook_link',
				'label'       => esc_attr__( 'Facebook', 'be-page' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'twitter_link',
				'label'       => esc_attr__( 'Twitter', 'be-page' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'pinterest_link',
				'label'       => esc_attr__( 'Pinterest', 'be-page' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'linkedin_link',
				'label'       => esc_attr__( 'LinkedIn', 'be-page' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

	}
	
	public function be_page_blog_layout_options(){
		
			$this->add_section( 'blog_layout_options', array(
				'title'          => esc_attr__( 'Blog Layout Options', 'be-page' ),
				'panel'          => $this->panel,
				'priority'       => 100,
			) );
			  
			$this->add_field( $this->config_id, array(
				'type'        => 'select',
				'settings'    => 'blog_layout_options',
				'label'       => __( 'Blog Layout Options', 'be-page' ),
				'description' => esc_attr__( 'Choose between different layout options to be used as default', 'be-page' ),
				'section'     => 'blog_layout_options',
				'default'     => 'sidebar-left',
				'priority'    => 10,
				'multiple'    => 1,
				'choices'     => array(
					'sidebar-left' 	=> esc_attr__( 'Primary Sidebar - Content', 'be-page' ),
					'sidebar-right' 		=> esc_attr__( 'Content - Primary Sidebar', 'be-page' ),
					
					
				),
			) );
			
			$this->add_field( $this->config_id, array(
				'type'        => 'number',
				'settings'    => 'excerpt_length',
				'label'       => esc_attr__( 'Set Blog Excerpt Length', 'be-page' ),
				'section'     => 'blog_layout_options',
				'default'     => '160',
			) );
			
			$this->add_field( $this->config_id, array(
				'type'        => 'select',
				'settings'    => 'blog_content_type',
				'label'       => __( 'Blog Posts Content type', 'be-page' ),
				'description' => esc_attr__( 'Choose between different Loop Posts Content options to be used as default', 'be-page' ),
				'section'     => 'blog_layout_options',
				'default'     => 'sidebar-left',
				'priority'    => 10,
				'multiple'    => 1,
				'choices'     => array(
					'excerpt' 		=> esc_attr__( 'Excerpt Only', 'be-page' ),
					'content' 		=> esc_attr__( 'Content Only', 'be-page' ),
				),
			) );

	}
	
	public function be_page_page_layout_options(){
		
			$this->add_section( 'page_layout_options', array(
				'title'          => esc_attr__( 'Page Layout Options', 'be-page' ),
				'panel'          => $this->panel,
				'priority'       => 100,
			) );
			  
			$this->add_field( $this->config_id, array(
				'type'        => 'select',
				'settings'    => 'page_layout_options',
				'label'       => __( 'Page Layout Options', 'be-page' ),
				'description' => esc_attr__( 'Choose between different layout options to be used as default', 'be-page' ),
				'section'     => 'page_layout_options',
				'default'     => 'sidebar-left',
				'priority'    => 10,
				'multiple'    => 1,
				'choices'     => array(
					'sidebar-right' 	=> esc_attr__( 'Primary Sidebar - Content', 'be-page' ),
					'sidebar-left' 		=> esc_attr__( 'Content - Primary Sidebar', 'be-page' ),
					
					
				),
			) );
			
			
	}
	
	
	
}
be_page_Kirki_Options::instance();

endif;