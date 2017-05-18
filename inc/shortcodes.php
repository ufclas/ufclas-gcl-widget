<?php 
/**
 * Gator CareerLink Widget Shortcode
 * 
 * Example [gator-careerlink-widget]
 * 
 * @todo Add support for different csm sources
 * 
 * @param  array $atts Shortcode attributes
 * @param  string $content 
 * @return string Shortcode output
 *                
 * @since 0.1.0
 */
function ufclas_gcl_widget_shortcode($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'csm' => 'ufl-csm.symplicity.com',
			'id' => '',
			'size' => 'auto',
			'css' => 'http://ufl-csm.symplicity.com/css/list_jobs_widget.css',
			'logo' => '',
			'header_text' => __('Gator CareerLink Jobs', 'ufclas-gcl-widget'),
			'width' => '320',
			'height' => '480',
			'sort_by' => 'posting_date',
		), $atts )
	);
	
	// Fixed attributes, users can't override these values for now
	$default_csm = 'ufl-csm.symplicity.com';
	$default_css = 'http://ufl-csm.symplicity.com/css/list_jobs_widget.css';

	// Support either image ID or image url
	$header_text = esc_attr( $header_text );
	$id = esc_attr( $id );
	
	// Support either image ID or image url
	$logo = ( is_numeric( $logo ) )? wp_get_attachment_image_src( $logo, 'full' ) : array($logo);
	$logo = ( !empty( $logo[0] ) )? esc_url( $logo[0] ) : '';
	
	// If missing ID, return an error message
	if ( empty( $id ) ){
		$widget_error = __('No ID found.', 'ufclas-gcl-widget');
		return sprintf('<span class="gcl-widget-error">%s Error: %s<span>', $header_text, $widget_error);
	}
	
	ob_start();
	?>
	<div id="symp_jobswidget"
		 data-csm="<?php echo $default_csm; ?>" 
		 data-id="<?php echo $id; ?>" 
		 data-size="<?php echo $size; ?>" 
		 data-css="<?php echo $default_css; ?>" 
		 data-logo="<?php echo $logo; ?>" 
		 data-header-text="<?php echo $header_text; ?>" 
		 data-width="<?php echo $width; ?>" 
		 data-height="<?php echo $height; ?>" 
		 data-sort-by="<?php echo $sort_by; ?>"></div>
	<script>(function(d, s, id) { var js, sjs = d.getElementsByTagName(s)[0];   if (d.getElementById(id)) {return;}   js = d.createElement(s); js.id = id;   js.src = "https://static.symplicity.com/jslib/jobswidget/jobswidget.js";   sjs.parentNode.insertBefore(js, sjs); }(document, "script", "symp_jobswidget_js"));</script>
	<?php
	return ob_get_clean();
}
add_shortcode('gator-careerlink-widget', 'ufclas_gcl_widget_shortcode');
