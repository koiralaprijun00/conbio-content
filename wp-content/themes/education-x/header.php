<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package education-x
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<?php if (education_x_get_option('page_loader_setting') == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="loader">
                <i class="fa fa-cog loader-icon loader-1"></i>
                <i class="fa fa-cog loader-icon loader-2"></i>
            </div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (education_x_get_option('homepage_layout_option') == 'full-width') {
    $education_x_homepage_layout = 'full-screen-layout';
} elseif (education_x_get_option('homepage_layout_option') == 'boxed') {
    $education_x_homepage_layout = 'boxed-layout';
}
if (education_x_get_option('show_footer_page_section') == 1) {
    $education_x_footer_fix_cta = 'footer-cta-enable';
} else {
    $education_x_footer_fix_cta = '';
}
?>
<div id="page"
     class="site <?php echo esc_attr($education_x_homepage_layout); ?> <?php echo esc_attr($education_x_footer_fix_cta); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'education-x'); ?></a>
    <header id="masthead" class="site-header site-header-second" role="banner">
        <?php if ((education_x_get_option('enable_header_contact_section') == 1) || ( has_nav_menu( 'social' ) ) ){ ?>
        <div class="top-bar">
            <div class="container">
                <div class="row">

                    <?php if (education_x_get_option('enable_header_contact_section') == 1) { ?>
                        <div class="col-lg-8 col-sm-12 col-xs-12">
                            <div class="header-links">
                                <ul class="link-list">
                                    <?php
                                    $education_x_top_header_telephone = esc_html(education_x_get_option('top_header_telephone'));
                                    if (!empty($education_x_top_header_telephone)) { ?>
                                        <li class="link-tel">
                                            <div class="link-wrapper">
                                        <span class="link-icon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                                <span class="link-detail">
                                            <a href="tel:<?php echo preg_replace('/\D+/', '', esc_attr(education_x_get_option('top_header_telephone'))); ?>">
                                                        <?php echo esc_html(education_x_get_option('top_header_telephone')); ?>
                                                </a>
                                        </span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $education_x_top_header_email = esc_html(education_x_get_option('top_header_email'));
                                    if (!empty($education_x_top_header_email)) { ?>
                                        <li class="link-email">
                                            <div class="link-wrapper">
                                            <span class="link-icon">
                                                <i class="fa fa-envelope-o"></i>
                                            </span>
                                                <span class="link-detail">
                                            <a href="mailto:<?php echo esc_html(education_x_get_option('top_header_email')); ?>"><?php echo esc_html(antispambot(education_x_get_option('top_header_email'))); ?></a>
                                        </span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $education_x_top_header_location = esc_html(education_x_get_option('top_header_location'));
                                    if (!empty($education_x_top_header_location)) { ?>
                                        <li class="link-address">
                                            <div class="link-wrapper">
                                                <span class="link-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </span>
                                                <span class="link-detail">
                                                    <?php echo esc_html(education_x_get_option('top_header_location')); ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="close-popup-1 d-none d-xs-block d-sm-block d-md-none"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-lg-4 col-xs-12 pull-right">
                        <div class="tm-top-right">
                            <div class="nav-icon icon-contact  d-block  d-sm-block d-md-none">
                                <i class="fa fa-map-marker"></i>
                            </div>

                            <div class="social-icons">
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'social',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'menu_class' => false
                                    )); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
        <?php
        if (education_x_get_option('enable_nav_overlay') == 1) {
            $enable_nav_overlay = 'header-overlay';
        } else {
            $enable_nav_overlay = '';
        }
        ?>
        <div class="header-main <?php echo esc_attr($enable_nav_overlay); ?>">
            <div class="container">
                <div class="row equal-row">
                    <div class="col-lg-3 col-sm-12 col-xs-12">
                        <div class="table-align">
                            <div class="site-branding">
                                <?php
                                if (is_front_page() && is_home()) : ?>
                                    <span class="site-title">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                <?php bloginfo('name'); ?>
                                            </a>
                                        </span>
                                <?php else : ?>
                                    <span class="site-title">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                <?php bloginfo('name'); ?>
                                            </a>
                                        </span>
                                <?php endif;
                                education_x_the_custom_logo();
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) : ?>
                                    <p class="site-description"><?php echo $description; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-12 col-xs-12">
                        <div class="site-navigation">
                            <div class="pull-right">
                                <div class="icon-search">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <nav class="main-navigation" role="navigation">
                                <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false" tabindex="0">
                                     <span class="screen-reader-text">
                                        <?php esc_html_e('Primary Menu', 'education-x'); ?>
                                    </span>
                                    <i class="ham"></i>
                                </span>

                                <?php wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_id' => 'primary-menu',
                                    'container' => 'div',
                                    'container_class' => 'menu main-menu'
                                )); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </header>

    <div class="popup-search">
        <div class="table-align">
            <div class="table-align-cell v-align-middle">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="close-popup"></div>
    </div>

    <!-- #masthead -->
    <!-- Innerpage Header Begins Here -->
    <?php
    if (is_front_page() && !is_home()) {
    } else {
        do_action('education-x-page-inner-title');
    }
    ?>
    <?php
    if (is_front_page()) {
        do_action('education_x_action_slider_section');
    }
    ?>
    <!-- Innerpage Header Ends Here -->
    <div id="content" class="site-content">

