<?php 
/**
 * Gator CareerLink Jobs Widget
 * 
 * @todo Add support for different csm sources
 *
 * @package UFCLAS_GCL_Widget
 * @since 0.1.0
 */
class UFCLAS_GCL_Jobs_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-gcl-jobs',
			'description' => __('Display a Gator CareerLink Job List. Note: Widget does not support multiple instances on a page.', 'ufclas-gcl-widget'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'gcl-jobs', __('Gator CareerLink Jobs Widget', 'ufclas-gcl-widget'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) )? $instance['title'] : ''; 
		$id = ( !empty( $instance['id'] ) )? $instance['id'] : ''; 
		$width = ( !empty( $instance['width'] ) )? $instance['width'] : ''; 
		$height = ( !empty( $instance['height'] ) )? $instance['height'] : ''; 
		$logo = ( !empty( $instance['logo'] ) )? $instance['logo'] : '';
		
		echo $args['before_widget'];
		
		echo do_shortcode( sprintf('[gator-careerlink-widget id="%s" header_text="%s" logo="%s" width="%s" height="%s"]', 
			$id,
			$title,
			$logo,
			$width,
			$height
		) );
		
		echo $args['after_widget'];
	}
	
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'id' => '', 'width' => '', 'height' => '', 'logo' => '' ) );
		
		$title = sanitize_text_field( $instance['title'] );
		$id = sanitize_text_field( $instance['id'] );
		$width = ( !empty( $instance['width'] ) )? sanitize_text_field( $instance['width'] ) : 320;
		$height = ( !empty( $instance['height'] ) )? sanitize_text_field( $instance['height'] ) : 400;
		$logo = ( isset( $instance['logo'] ) )? $instance['logo'] : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Header Text:', 'ufclas-gcl-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('ID:', 'ufclas-gcl-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'ufclas-gcl-widget'); ?></label>
		<input class="" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'ufclas-gcl-widget'); ?></label>
		<input class="" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" /></p>
		
        <p>
        <label for="<?php echo $this->get_field_id( 'logo' ); ?>"><?php _e( 'Image', 'ufclas-ufl-2015' ); ?>:</label>
        <div class="wpshed-media-container">
            <div class="wpshed-media-inner">
                <?php $img_style = ( $instance[ 'logo' ] != '' ) ? '' : 'style="display:none;"'; ?>
                <img id="<?php echo $this->get_field_id( 'logo' ); ?>-preview" src="<?php echo esc_attr( $instance['logo'] ); ?>" <?php echo $img_style; ?> />
                <?php $no_img_style = ( $instance[ 'logo' ] != '' ) ? 'style="display:none;"' : ''; ?>
                <span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'logo' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'ufclas-ufl-2015' ); ?></span>
            </div>
        <input type="text" id="<?php echo $this->get_field_id( 'logo' ); ?>" name="<?php echo $this->get_field_name( 'logo' ); ?>" value="<?php echo esc_attr( $instance['logo'] ); ?>" class="wpshed-media-url" />
		<input type="button" value="<?php echo _e( 'Remove', 'ufclas-ufl-2015' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'logo' ); ?>-remove" <?php echo $img_style; ?> />
		<?php $image_button_text = ( $instance[ 'logo' ] != '' ) ? __( 'Change Image', 'ufclas-ufl-2015' ) : __( 'Select Image', 'ufclas-ufl-2015' ); ?>
        <input type="button" value="<?php echo $image_button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'logo' ); ?>-button" />
        <br class="clear">
        </div>
		</p>
       
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['id'] = sanitize_text_field( $new_instance['id'] );
		$instance['width'] = sanitize_text_field( $new_instance['width'] );
		$instance['height'] = sanitize_text_field( $new_instance['height'] );
		$instance['logo'] = esc_url_raw( $new_instance['logo'] );
		return $instance;
	}

}