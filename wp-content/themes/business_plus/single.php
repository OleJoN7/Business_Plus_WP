<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package business_plus
 */

get_header('custom'); ?>

    <section class="blog-post-section">
        <div class="container">
            <header class="blog-post-header">
                <h2 class="blog-post-title"><?php echo get_theme_mod('blog_post_title_settings'); ?></h2>
                <p class="blog-post-subtitle"><?php echo get_theme_mod('blog_post_subtitle_settings'); ?></p>
            </header>
            <div class="blog-post">
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
                                            href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>, <?php the_time('F-  j-  Y'); ?>
                                </p>
                                <?php if (has_post_thumbnail()) : ?> <a class="d-inline-block thumbnail-wrap" href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(); ?></a>
                                <?php endif; ?>
                                <?php echo the_content(); ?>
                                <?php
                                if ( get_post_meta( $post->ID, 'Heading of custom text', true )) { ?>

                                    <p class="custom-heading"><?php echo get_post_meta($post->ID, 'Heading of custom text', true); ?></p>
                                <?php } ?>

                                <?php
                            if ( get_post_meta( $post->ID, 'First custom paragraph', true )) { ?>

                                <p class="custom-first-paragraph"><?php echo get_post_meta($post->ID, 'First custom paragraph', true); ?></p>

                            <?php  }?>
                            <?php
                            if ( get_post_meta( $post->ID, 'Marked custom paragraph', true )) { ?>

                                <p class="custom-middle-paragraph"><?php echo get_post_meta($post->ID, 'Marked custom paragraph', true); ?></p>
                            <?php  } ?>
                            <?php
                            if ( get_post_meta( $post->ID, 'Last custom paragraph', true )) { ?>

                                <p class="custom-last-paragraph"><?php echo get_post_meta($post->ID, 'Last custom paragraph', true); ?></p>
                            <?php } ?>

                                <p class="float-left social-block">Share : <?php echo do_shortcode('[addtoany]'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php
                else :
                    echo '<p>Nothing to show</p>';

                endif;
                ?>
                <div class="author-info d-flex">
                    <div class="author-gravatar col-lg-2 col-md-4 col-xs-12">
                      <?php echo get_avatar(get_the_author_meta('ID'),165) ?>
                        <p class="author-name"><?php echo get_the_author_meta('nickname')  ?></p>
                    </div>
                    <div class="author-biographical-info col-lg-10 col-md-8 col-xs-12">
                            <?php echo wpautop(get_the_author_meta('description'))  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php comments_template(); ?>

<?php
get_sidebar();
get_footer();
