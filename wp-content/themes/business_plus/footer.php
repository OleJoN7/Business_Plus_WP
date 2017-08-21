<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business_plus
 */

?>

<footer class="main-footer">
    <div class="container d-flex justify-content-between">
        <div class="footer-logo-block align-self-center">
            <div class="footer-logo-container">
                <?php echo get_custom_logo() ?>
            </div>
            <p>2015 &copy lawyer.</p>
            <ul class="social-icons d-flex">
                <?php
                $social_links_facebook = get_theme_mod('social_links_facebook');
                $social_links_twitter = get_theme_mod('social_links_twitter');
                $social_links_google = get_theme_mod('social_links_google');
                $social_links_linkedin = get_theme_mod('social_links_linkedin');?>
                    <li><a target="_blank" href="<?php echo esc_url($social_links_facebook) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?php echo esc_url($social_links_google) ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?php echo esc_url($social_links_twitter) ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?php echo esc_url($social_links_linkedin) ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="footer-nav">
            <h4>Navigation</h4>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class' => 'footer-navbar-nav',
                'container' => false,
                'before' => '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            )); ?>
        </div>
        <div class="footer-form">
            <h4>Quick contact us</h4>
            <?php echo do_shortcode('[contact-form-7 id="221" title="Contact form 1"]'); ?>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
