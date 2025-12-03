<?php
/**
 * The template for displaying home page.
 * @package education-x
 */

get_header();
if ('posts' == get_option('show_on_front')) {
    include(get_home_template());
} else {
    /**
     * education_x_action_front_page hook
     * @since education-x 0.0.2
     *
     * @hooked education_x_action_front_page -  10
     * @sub_hooked education_x_action_front_page -  10
     */
    do_action('education_x_action_front_page');

    if (education_x_get_option('home_page_content_status') == 1) {
        ?>
        <section class="section-block recent-blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        while (have_posts()) : the_post();
                            the_title('<h2 class="section-title">', '</h2>');
                            get_template_part('template-parts/content', 'page');

                        endwhile; // End of the loop.
                        ?>
                    </div><!-- #primary -->
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
    <?php }
}
get_footer();