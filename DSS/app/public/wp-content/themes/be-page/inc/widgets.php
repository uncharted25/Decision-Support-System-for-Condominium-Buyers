<?php
/**
 * Custom theme widgets.
 *
 * @package Be Page
 */
 if ( ! function_exists( 'be_page_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function be_page_register_widgets() {
		register_widget( 'be_page_features_box_class' );
	}
add_action( 'widgets_init', 'be_page_register_widgets' );
endif;


if ( ! class_exists( 'be_page_features_box_class' ) ) :

	/**
	 * Work Process
	 *
	 * @since 1.0.0
	 */
	class be_page_features_box_class extends Be_Page_Widget_Helper {
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'be-features-box';
			$args['label'] = esc_html__( 'Be Page: Features Box', 'be-page' );
			$args['widget'] = array(
				'classname'                   => 'be_page_features_widgets',
				'description'                 => esc_html__( 'Be Page: Features Box Widgets.', 'be-page' ),
				'customize_selective_refresh' => true,
			 	
			);

			$args['fields'] = array(
					'be_title' => array(
						'label' => esc_html__( 'Title:', 'be-page' ),
						'type'  => 'text',
						'class' => 'widefat',
						),
					'be_text' => array(
						'label' => esc_html__( 'Text', 'be-page' ),
						'type'  => 'textarea',
						'class' => 'widefat',
						),	
					'be_image' => array(
						'label' => esc_html__( 'Image URL', 'be-page' ),
						'type'  => 'text',
						'class' => 'widefat',
						),
					'be_icon' => array(
						'label' => esc_html__( 'Choose icon', 'be-page' ),
						'type'  => 'text',
						'description' => esc_html__( 'You can choose from fontawesome ( https://fontawesome.com/v4.7.0/

)', 'be-page' ),
						'class' => 'widefat',
						'default' => esc_attr( 'fa fa-car' ),
						),			
				
				);
			
			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			$values = $this->get_field_values( $instance );
			echo $args['before_widget'];
			
			
		
			$img_style = ( $values['be_image'] != "" ) ? "background-image: url('".esc_url( $values['be_image'] )."'); background-position: center bottom; background-size: cover; " : '';
			
			printf ( '<div class="be-feature-box" style="%1$s">
			  <div class="box-wrp">
				<div class="be-icon"> <i aria-hidden="true" class="fa %2$s"></i> </div>
				<div class="fancy-content">
				  <h3 class="be-tw-6 be-pt-15 be-pb-10 heading">%3$s</h3>
				  <div class="be-page-text">%4$s</div>
				</div>
			  </div>
			</div>
			',$img_style,$values['be_icon'],$values['be_title'],$values['be_text']);
		
			echo $args['after_widget'];

			
		}

		
	}
	
endif;

