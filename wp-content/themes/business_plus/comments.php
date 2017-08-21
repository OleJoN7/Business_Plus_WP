<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package business_plus
 */
if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-section">
    <div class="container">
        <?php
        // You can start editing here -- including this comment!
        if (have_comments()) : ?>
        <header class="comments-header">
            <h2 class="comments-title"><?php echo get_theme_mod('comments_title_settings'); ?></h2>
            <p class="comments-subtitle"><?php echo get_theme_mod('comments_subtitle_settings'); ?></p>
        </header><!-- .comments-title -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'business_plus'); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'business_plus')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'business_plus')); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>

        <?php
        function mytheme_comment($comment, $args, $depth){
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="d-flex">
                <div class="visitor-avatar col-lg-2 col-xs-12">
                    <?php echo get_avatar($comment, $size = '75', '', '', array('class' => 'img-responsive rounded-circle')) ?>


                </div>
                <div class="comment-block col-lg-10  col-xs-12">
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php esc_html(__('Waiting for check.', 'business_plus')) ?></em>
                        <br/>
                    <?php endif; ?>

                    <div class="comment-meta">
                        <a href="<?php echo get_comment_author_link() ?>"
                           class="author-name-link text-uppercase"><?php echo get_comment_author_link() ?></a>
                        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"
                           class="text-uppercase"><?php printf('%1$s', get_comment_date()) ?></a>
                        <?php edit_comment_link('(Edit)', '', '') ?>
                    </div>
                    <div class="comment-text"><?php comment_text() ?></div>

                    <div class="reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => __(''), 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>

            </div>
            <?php
            }
            ?>

            <ul class="comment-list">
                <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
            </ul>


            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
                <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                    <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'business_plus'); ?></h2>
                    <div class="nav-links">

                        <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'business_plus')); ?></div>
                        <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'business_plus')); ?></div>

                    </div><!-- .nav-links -->
                </nav><!-- #comment-nav-below -->
                <?php
            endif; // Check for comment navigation.
            endif; // Check for have_comments().
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>

                <p class="no-comments"><?php esc_html_e('Comments are closed.', 'business_plus'); ?></p>
                <?php
            endif ?>
    </div>

    <div class="comment-form-wrap">
        <div class="container">
            <?php comment_form();
            ?>
        </div>
    </div>

</section><!-- #comments -->