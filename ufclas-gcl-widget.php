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