<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div id="page" class="site">
	<?php
	// Fallback: ensure helper functions are available even if theme init failed earlier.
	if ( ! function_exists( 'alone_header_mobile_menu' ) && file_exists( get_template_directory() . '/theme-includes/helpers.php' ) ) {
		include_once get_template_directory() . '/theme-includes/helpers.php';
	}

	if ( function_exists( 'alone_header_mobile_menu' ) ) {
		alone_header_mobile_menu();
	}

	if ( function_exists( 'alone_header' ) ) {
		alone_header();
	}
	?>
	<div id="main" class="site-main">
