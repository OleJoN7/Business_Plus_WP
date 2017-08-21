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

get_header('custom'); ?>


    <section class="blog-section">
        <div class="container">
            <header class="blog-header">
                <h2 class="blog-title"><?php echo get_theme_mod('blog_title_settings'); ?></h2>
                <p class="blog-subtitle"><?php echo get_theme_mod('blog_subtitle_settings'); ?></p>
            </header>
            <div class="blog-posts">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <div class="post d-flex">
                            <div class="author-avatar">
                                <?php
                                global $current_user;
                                get_currentuserinfo();
                                echo wpautop(get_avatar($current_user->ID, 60)); ?>
                            </div>
                            <div class="post-info">
                                <p class="post-heading"><?php the_title(); ?></p>
                                <p class="post-date">Posted by: <a
                                            href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>, <?php the_time('F- j-  Y'); ?>
                                </p>
                                <?php if (has_post_thumbnail()) : ?> <a class="d-inline-block thumbnail-wrap" href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(); ?></a>
                                <?php endif; ?>
                                <?php echo the_excerpt(); ?>
                                <p class="float-left social-block">Share : <?php echo do_shortcode('[addtoany]');?></p>
                                <a class="d-inline-block float-right btn btn-blog-link"
                                   href="<?php the_permalink(); ?>">Read more</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php
                else :
                    echo '<p>Nothing to show</p>';

                endif;
                ?>
            </div>
            <div class="pagination-block-wrap">
                <div class="pagination-block">
                    <?php
                    echo paginate_links(array(
                        'prev_next' => false,
                        'before_page_number' => '',
                        'after_page_number' => '',
                        'end_size' => 1,
                        'mid_size' => 1,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_sidebar();
get_footer();
