<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package business_plus
 */

?>

<article class="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="container">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </div>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="container">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'business_plus'),
                'after' => '</div>',
            ));
            ?>
            <section class="clients-section">
                <header class="clients-header">
                    <h2 class="clients-title"><?php echo get_theme_mod('clients_title_settings'); ?></h2>
                    <p class="clients-subtitle"><?php echo get_theme_mod('clients_subtitle_settings'); ?></p>
                </header>
                <div class="clients-slider">
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
            </section>
            <section class="partners-section">
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
                                    <a class="d-inline-block"
                                       href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>
            </section>
        </div>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
