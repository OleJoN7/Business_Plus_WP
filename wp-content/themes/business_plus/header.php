<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business_plus
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section class="welcome-section">
    <header class="main-header">
        <div class="container">
            <nav id="site-navigation" class="navbar navbar-toggleable-md navbar-inverse main-nav" role="navigation">
                <div class="navbar-brand">
                    <?php the_custom_logo(); ?>
                    <h1>Business Plus</h1>
                </div>
                <div class="phone-wrap"><a href="tel: +9978 8856 999" class="phone-link"><i class="fa fa-phone" aria-hidden="true"></i><span><?php echo get_theme_mod('welcome-phone_settings')?></span></a></div>
                <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class' => 'navbar-nav',
                    'container_class' => 'navbar-collapse collapse justify-content-end',
                    'container_id' => 'navbarsExampleDefault'
                )); ?>
            </nav>
        </div>
    </header>
    <div id="carouselExampleIndicators" class="carousel slide slider" data-ride="carousel">
        <div class="container">
            <div class="carousel-inner" role="listbox">
            <?php
            $args = array(
                'post_type' => 'slides'
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()):?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="carousel-item <?php if ( $the_query->current_post == 0 ) : ?>active<?php endif; ?>">
                        <p class="welcome-text"><?php echo get_theme_mod('welcome-slider-customtext_settings')?></p>
                        <h2><?php the_title(); ?></h2>
                        <div class="slide-text"><?php the_excerpt(); ?></div>
                        <div class="hvr-underline-reveal"><a href="<?php the_permalink() ?>" class="btn btn-slider">Read More</a></div>
                    </div>
                    <?php endwhile; ?>
            <?php endif;
            wp_reset_postdata(); ?>
            </div>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
    </div>
</section>
