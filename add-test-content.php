<?php
/**
 * Temporary setup script: adds a pull-quote block to the first post
 * and inserts 3 test comments (including a reply).
 *
 * HOW TO USE:
 *   Place this file in your WordPress root (where wp-config.php lives),
 *   visit http://scalernews.local/add-test-content.php in your browser,
 *   then DELETE this file immediately after.
 *
 * WARNING: Remove this file before deploying to production.
 */

define('ABSPATH', __DIR__ . '/');

// Bootstrap WordPress
require_once __DIR__ . '/wp-load.php';

if (!current_user_can('administrator')) {
    // Allow running from CLI / localhost without login
    $admins = get_users(array('role' => 'administrator', 'number' => 1));
    if ($admins) {
        wp_set_current_user($admins[0]->ID);
    }
}

$output = array();

// -----------------------------------------------------------------------
// 1. Add pull-quote block to the first published post
// -----------------------------------------------------------------------
$posts = get_posts(array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
));

if ($posts) {
    $post = $posts[0];
    $post_id = $post->ID;

    $pullquote_block = '
<!-- wp:pullquote -->
<figure class="wp-block-pullquote"><blockquote><p>"We are witnessing the slow tectonic shift of institutional trust. What was once carved in stone is now written in shifting sands."</p><cite>— Dr. Alistair Cook, Global Affairs Analyst</cite></blockquote></figure>
<!-- /wp:pullquote -->

';

    // Only add if not already present
    if (strpos($post->post_content, 'wp:pullquote') === false) {
        $new_content = $post->post_content . $pullquote_block;
        wp_update_post(array(
            'ID' => $post_id,
            'post_content' => $new_content,
        ));
        $output[] = "✅ Pull-quote block added to post ID {$post_id}: \"{$post->post_title}\"";
    } else {
        $output[] = "ℹ️  Pull-quote already exists in post ID {$post_id}";
    }

    // -----------------------------------------------------------------------
    // 2. Add 3 test comments (2 top-level + 1 reply)
    // -----------------------------------------------------------------------
    $existing = get_comments(array('post_id' => $post_id, 'count' => true));

    if ($existing < 3) {
        $comment1_id = wp_insert_comment(array(
            'comment_post_ID' => $post_id,
            'comment_author' => 'Eleanor V.',
            'comment_author_email' => 'eleanor@example.com',
            'comment_author_url' => '',
            'comment_content' => 'An insightful look into a very complex situation. The tectonic shift analogy is particularly apt for where we stand in global diplomacy today.',
            'comment_approved' => 1,
            'comment_date' => current_time('mysql'),
        ));
        $output[] = "✅ Comment 1 added (ID: {$comment1_id})";

        $comment2_id = wp_insert_comment(array(
            'comment_post_ID' => $post_id,
            'comment_author' => 'Marcus T.',
            'comment_author_email' => 'marcus@example.com',
            'comment_author_url' => '',
            'comment_content' => 'The related data table really puts the GDP impact in perspective. Emerging markets bearing the brunt again.',
            'comment_approved' => 1,
            'comment_date' => current_time('mysql'),
        ));
        $output[] = "✅ Comment 2 added (ID: {$comment2_id})";

        if ($comment1_id) {
            $comment3_id = wp_insert_comment(array(
                'comment_post_ID' => $post_id,
                'comment_author' => 'Priya S.',
                'comment_author_email' => 'priya@example.com',
                'comment_author_url' => '',
                'comment_content' => 'Great point, Eleanor — and the digital infrastructure allocation debate is one that will define the next decade of diplomacy.',
                'comment_approved' => 1,
                'comment_parent' => $comment1_id,
                'comment_date' => current_time('mysql'),
            ));
            $output[] = "✅ Reply added (ID: {$comment3_id}) in reply to comment {$comment1_id}";
        }
    } else {
        $output[] = "ℹ️  Post already has {$existing} comments — skipping insertion.";
    }

    $output[] = '';
    $output[] = '🔗 View the post: ' . get_permalink($post_id);
    $output[] = '';
    $output[] = '⚠️  DELETE this file (add-test-content.php) now!';
} else {
    $output[] = '❌ No published posts found.';
}

echo '<pre style="font-family:monospace;font-size:15px;padding:2rem;">';
echo implode("\n", $output);
echo '</pre>';
