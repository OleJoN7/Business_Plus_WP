<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package business_plus
 */

get_header(); ?>

    <section class="about-section">
        <div class="container">
            <div class="d-flex justify-content-between">
                <header class="about-header col-lg-4 col-md-3 col-xs-12">
                    <h2 class="about-title"><?php echo get_theme_mod('about_title_settings'); ?></h2>
                    <p class="about-subtitle"><?php echo get_theme_mod('about_subtitle_settings'); ?></p>
                </header>
                <div class="col-lg-8 col-md-9 col-xs-12">
                    <article class="about-text"><?php echo get_theme_mod('about_article_settings'); ?></article>
                    <a class="btn btn-link-about"
                       href="<?php echo get_permalink(get_theme_mod('about_link_settings')) ?>">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section">
        <div class="container">
            <header class="services-header">
                <h2 class="services-title"><?php echo get_theme_mod('services_title_settings'); ?></h2>
                <p class="services-subtitle"><?php echo get_theme_mod('services_subtitle_settings'); ?></p>
            </header>
            <ul class="services-list d-flex flex-wrap">
                <?php
                $args = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'posts_per_page' => 4
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) :
                    $count = 0;
                    while ($the_query->have_posts()) : $count++ ?>
                        <?php $the_query->the_post(); ?>
                        <li class="services-post col-lg-6 col-md-12  d-flex">
                            <div class="col-md-2 col-xs-12">
                                <a href="<?php the_permalink() ?>"
                                   class="<?php if ($the_query->current_post == 0) : ?>service-hover<?php endif; ?>  fa fa-<?php echo sanitize_title_with_dashes(get_theme_mod('service_' . $count));
                                   if ($count == 4) {
                                       $count = 0;
                                   } ?> fa-5x"></a>
                            </div>
                            <div class="service-text-block <?php if ($the_query->current_post == 0) : ?>service-text-block-hover<?php endif; ?> col-md-10 col-xs-12">
                                <div>
                                    <h3 class="service-headline"><?php the_title(); ?></h3>
                                    <div class="service-text"><?php the_excerpt(); ?></div>
                                </div>
                            </div>
                        </li>

                    <?php endwhile; ?>
                <?php endif;
                wp_reset_postdata(); ?>
            </ul>
            <a class="btn btn-services-link"
               href="<?php echo get_permalink(get_theme_mod('services_link_settings')) ?>">View more</a>
        </div>
    </section>
    <section class="clients-section">
        <div class="container">
            <header class="clients-header">
                <h2 class="clients-title"><?php echo get_theme_mod('clients_title_settings'); ?></h2>
                <p class="clients-subtitle"><?php echo get_theme_mod('clients_subtitle_settings'); ?></p>
            </header>
        </div>
        <div class="clients-slider">
            <div class="container">
                <?php
                $args = array(
                    'post_type' => 'clients_slides',
                    'posts_per_page' => 9
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) :
                    $count = 0; ?>
                    <ul id="light-slider" class="d-flex justify-content-between">
                        <?php while ($the_query->have_posts()) : $count++ ?>
                            <?php
                            switch ($count) {
                                case(1):
                                    echo '<li class="clients-item d-flex flex-column gray-quote">';
                                    break;
                                case(2):
                                    echo '<li class="clients-item d-flex flex-column blue-quote">';
                                    break;
                                case(3):
                                    echo '<li class="clients-item d-flex flex-column red-quote">';
                                    $count = 0;
                                    break;
                            };
                            ?>
                            <?php $the_query->the_post(); ?>
                            <div class="clients-comments">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="clients-info d-flex">
                                <div class="clients-avatar rounded-circle">
                                    <?php
                                    the_post_thumbnail();
                                    ?>
                                </div>
                                <div class="clients-name">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo get_post_meta($post->ID, 'client_position', true); ?></p>
                                </div>
                            </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <section class="news-section">
        <div class="container">
            <header class="news-header">
                <h2 class="news-title"><?php echo get_theme_mod('news_title_settings'); ?></h2>
                <p class="news-subtitle"><?php echo get_theme_mod('news_subtitle_settings'); ?></p>
            </header>
            <div class="news-wrap clearfix">
                <?php
                global $post;
                $args = array(
                    'posts_per_page' => 3,
                    'category_name' => 'news'
                );
                $news_posts = get_posts($args);
                foreach ($news_posts as $post) : setup_postdata($post); ?>
                    <?php if ($post === $news_posts[0]) : ?>
                        <div class="first-news-post d-flex float-left">
                            <ul class="first-news-post-list col-lg-2 col-md-12">
                                <li class="first-news-post-info">
                                    <span class="first-news-post-day d-inline-block"><?php echo get_the_date('d ') ?></span>
                                    <span class="d-block first-news-post-year"><?php echo get_the_date('M-Y') ?></span>
                                </li>
                                <li class="first-news-post-info">
                                    <i class="fa fa-comments-o fa-2x"></i>
                                    <span class="d-block comments-count"><?php comments_number(
                                            $zero = 'No Com',
                                            $more = '%-Com'
                                        ) ?></span>
                                </li>
                                <li class="first-news-post-info">
                                    <i class="fa fa-eye fa-2x"></i>
                                    <span class="d-block post-views"><?php if (function_exists('the_views')) {
                                            the_views();
                                        } ?></span>
                                </li>
                            </ul>
                            <div class="info-img-block col-lg-10 col-md-12">
                                <div class="news-img-container">
                                    <a href="<?php the_permalink() ?>">
                                        <?php if (($post === $news_posts[0]) && has_post_thumbnail()) : echo the_post_thumbnail(); ?>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <a class="d-inline-block" href="<?php the_permalink() ?>">
                                    <h3 class="news-headline"><?php the_title() ?></h3>
                                </a>
                                <div class="news-text"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                    <?php else: ?>

                        <div class="float-right next-news-post ">
                            <a class="d-inline-block" href="<?php the_permalink() ?>">
                                <h3 class="news-headline"><?php the_title() ?></h3>
                            </a>
                            <span class="d-block news-date"><?php echo get_the_date('d - M - Y') ?></span>
                            <div class="news-text"><?php the_excerpt(); ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach;
                wp_reset_postdata(); ?>
                <a class="d-inline-block btn btn-news-link"
                   href="<?php echo get_permalink(get_theme_mod('news_link_settings')) ?>">View more</a>
            </div>
        </div>
    </section>
<section class="partners-section">
    <div class="container">
        <header class="partners-header">
            <h2 class="partners-title"><?php echo get_theme_mod('partners_title_settings'); ?></h2>
            <p class="partners-subtitle"><?php echo get_theme_mod('partners_subtitle_settings'); ?></p>
        </header>
        <div class="partners-slider-wrap">
                <?php
                $args = array(
                    'post_type' => 'partners_slides',
                    'posts_per_page' => 15
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()):?>
                    <ul id="partners-slider" class="d-flex">
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <li>
                                <a class="d-inline-block" href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif;
                wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php
get_sidebar();
get_footer();
