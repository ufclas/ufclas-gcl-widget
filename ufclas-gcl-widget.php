<?php
/**
 * Plugin Name:     UFCLAS Gator CareerLink Widget
 * Plugin URI:      https://it.clas.ufl.edu/
 * Description:     Widget and shortcode to use Gator CareerLink (Symplicity) Job Widget code in WordPress
 * Author:          Priscilla Chapman (CLAS IT)
 * Author URI:      https://it.clas.ufl.edu/
 * Text Domain:     ufclas-gcl-widget
 * Domain Path:     /languages
 * Version:         0.1.0
 * Build Date:		20170517
 *
 * @package         UFCLAS_GCL_Widget
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Set path to current plugin folder, includes trailing slash
define( 'UFCLAS_GCL_WIDGET_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Include files
 */
require_once UFCLAS_GCL_WIDGET_DIR . 'inc/widgets.php';
require_once UFCLAS_GCL_WIDGET_DIR . 'inc/shortcodes.php';


/**
 * Register Widgets
 * 
 * @since 0.1.0
 */
function ufclas_gcl_widget_init(){
	register_widget( 'UFCLAS_GCL_Jobs_Widget' );
}
add_action( 'widgets_init', 'ufclas_gcl_widget_init' );

/**
 * Add plugin CSS and JS
 * 
 * @since 0.1.0
 */
function ufclas_gcl_widget_enqueue_scripts(){
	wp_enqueue_style('gcl-widget', plugins_url('/css/gcl-widget.css', __FILE__), array(), null, 'screen' );
	wp_enqueue_script('gcl-widget', plugins_url('/js/gcl-widget.js', __FILE__), array('jquery'), null );
}
add_action( 'wp_enqueue_scripts', 'ufclas_gcl_widget_enqueue_scripts' );

/**
 * Add Image upload scripts for widgets 
 *
 * @link https://wpshed.com/wordpress/image-upload-widget/
 * @since 0.1.0
 */
function ufclas_gcl_widget_image_upload_scripts() {
	global $pagenow, $wp_customize;
	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'wpshed-image-upload', plugins_url('/inc/image-upload/upload.js', __FILE__), array( 'jquery' ) );
		wp_enqueue_style( 'wpshed-image-upload',  plugins_url('/inc/image-upload/upload.css', __FILE__) );
	}
}
add_action( 'admin_enqueue_scripts', 'ufclas_gcl_widget_image_upload_scripts' );