<?php 
/**
 * Gator CareerLink Jobs Widget
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
			'description' => __('Display a Gator CareerLink Job List', 'ufclas-gcl-widget'),
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
		
		echo $args['before_widget'];
		
		var_dump( $args );
		//echo do_shortcode( 'gator-careerlink-widget' );
		
		echo $args['after_widget'];
	}

}