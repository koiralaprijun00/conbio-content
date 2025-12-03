<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package education-x
 */

?>
</div>

<!-- #content -->
<footer id="colophon" class="site-footer">
    <?php $education_x_footer_widgets_number = education_x_get_option('number_of_footer_widget');
    if (1 == $education_x_footer_widgets_number) {
        $col = 'col-md-12';
    } elseif (2 == $education_x_footer_widgets_number) {
        $col = 'col-md-6';
    } elseif (3 == $education_x_footer_widgets_number) {
        $col = 'col-md-4';
    } elseif (4 == $education_x_footer_widgets_number) {
        $col = 'col-md-3';
    } else {
        $col = 'col-md-3';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <?php if (is_active_sidebar('footer-col-one') && $education_x_footer_widgets_number > 0) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $education_x_footer_widgets_number > 1) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $education_x_footer_widgets_number > 2) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $education_x_footer_widgets_number > 3) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="footer-bottom">
        <div class="container">
            <div class="row equal-row">
                <div class="col-sm-6 col-xs-12">
                    <div class="tm-social-share table-align">
                        <?php if (education_x_get_option('social_icon_style') == 'circle') {
                            $education_x_social_icon = 'bordered-radius';
                        } else {
                            $education_x_social_icon = '';
                        } ?>
                        <div class="social-icons table-align-cell v-align-middle <?php echo esc_attr($education_x_social_icon); ?>">
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


                <div class="col-sm-6 col-xs-12">
                    <div class="contact-details table-align">
                        <div class="table-align-cell v-align-middle">
                        <ul class="footer-contact">
                            <?php $education_x_top_header_location = esc_html(education_x_get_option('top_header_location'));
                            if (!empty($education_x_top_header_location)) { ?>
                            <li><?php echo esc_html(education_x_get_option('top_header_location')); ?>
                            </li>
                            <?php } ?>
                            <?php $education_x_top_header_email = esc_html(education_x_get_option('top_header_email'));
                            if (!empty($education_x_top_header_email)) { ?>
                            <li><a href="mailto:<?php echo esc_html( education_x_get_option('top_header_email') ); ?>"><?php echo esc_html( antispambot(education_x_get_option('top_header_email'))); ?></a>
                            </li>
                            <?php } ?>
                            <?php $education_x_top_header_telephone = esc_html(education_x_get_option('top_header_telephone'));
                            if (!empty($education_x_top_header_telephone)) { ?>
                                <li><a href="tel:<?php echo preg_replace( '/\D+/', '', esc_attr( education_x_get_option('top_header_telephone') ) ); ?>">
                                        <?php echo esc_html( education_x_get_option('top_header_telephone') ); ?>
                                    </a></li>
                            <?php } ?>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                    <span class="footer-divider"></span>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="site-copyright">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $education_x_copyright_text = education_x_get_option('copyright_text');
                                if (!empty ($education_x_copyright_text)) {
                                    echo wp_kses_post($education_x_copyright_text);
                                }
                                ?>
                            </div>

                            <div class="col-sm-6">
                                <div class="pull-right">
                                    <?php printf(esc_html__('Theme: %1$s by %2$s', 'education-x'), '<a href="https://www.thememattic.com/theme/education-x/" target = "_blank" >Education X</a>', '<a href="https://thememattic.com" target = "_blank" rel="designer">Themematic </a>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<?php
if (1 == education_x_get_option('show_footer_page_section')) {
    $education_x_footer_fix_button_enable = education_x_get_option('show_footer_fix_page_button');
    $education_x_footer_fix_button_text = education_x_get_option('fix_page_button_text');
    $education_x_footer_fix_button_url = education_x_get_option('fix_page_button_link');
    $education_x_footer_fix_page = array();
    $education_x_footer_fix_page[] = esc_attr(education_x_get_option('select_footer_page'));
    $education_x_fix_page_page_excerpt_number = absint(education_x_get_option('number_of_content_home_footer_page'));
    if (!empty($education_x_footer_fix_page)) {
        $education_x_fix_page_page_args = array(
            'orderby' => 'post__in',
            'post_type' => 'page',
            'post__in' => $education_x_footer_fix_page,
        );
    }
    if (!empty($education_x_fix_page_page_args)) {
        $education_x_fix_page_page_query = new WP_Query($education_x_fix_page_page_args);
        while ($education_x_fix_page_page_query->have_posts()): $education_x_fix_page_page_query->the_post();
            if (has_excerpt()) {
                $education_x_fix_page_page_main_content = get_the_excerpt();
            } else {
                $education_x_fix_page_page_main_content = education_x_words_count($education_x_fix_page_page_excerpt_number, get_the_content());
            }
            if (has_post_thumbnail()) {
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = $thumb['0'];
            } else {
                $url = NULL;
            }
            ?>
            <div class="footer-cta primary-bgcolor data-bg bg-fixed" data-background="<?php echo esc_url($url); ?>">
                <div class="container high-index">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="section-header">
                                <h2 class="section-title section-title2"><?php the_title(); ?></h2>
                            </div>
                            <div class="section-content">
                                <?php echo esc_html($education_x_fix_page_page_main_content); ?>
                            </div>

                            <div class="cta-btn-group" role="group" aria-label="buttons">
                                <?php if ($education_x_footer_fix_button_enable == 1) { ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="btn btn-sm btn-primary tm-shadow"><?php _e('View More', 'education-x'); ?></a>
                                <?php } ?>
                                <?php if (!empty($education_x_footer_fix_button_text)) { ?>
                                    <a href="<?php echo esc_url($education_x_footer_fix_button_url); ?>"
                                       class="btn btn-sm btn-border"><?php echo esc_html($education_x_footer_fix_button_text); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-overlay primary-bgcolor"></div>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    }
} ?>

<a id="scroll-up">
    <i class="fa fa-angle-up"></i>
</a>

<?php wp_footer(); ?>

</body>
</html>