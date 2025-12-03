<?php
// Bootstrap theme functionality.
include_once get_template_directory() . '/theme-includes/init.php';

// Log for troubleshooting to confirm functions.php loads.
if ( function_exists( 'error_log' ) ) {
	error_log( 'alone theme functions.php loaded' );
}

// Allow additional mime types for uploads.
function my_custom_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	$mimes['doc']  = 'application/msword';
	unset( $mimes['exe'] );
	return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );
