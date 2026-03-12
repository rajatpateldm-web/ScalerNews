<?php
/**
 * ScalerNews Template Tags
 *
 * Custom template tags for this theme.
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Calculate reading time for a post.
 *
 * @param int $post_id Optional. Post ID. Default current post.
 * @return string Reading time text.
 */
function scalernews_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, ceil( $word_count / 200 ) );

	return sprintf(
		/* translators: %d: number of minutes */
		_n( '%d min read', '%d min read', $minutes, 'scalernews' ),
		$minutes
	);
}

/**
 * Display breadcrumbs.
 */
function scalernews_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	?>
	<nav class="sn-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'scalernews' ); ?>" style="font-size:var(--sn-text-sm);color:var(--sn-color-text-secondary);margin-bottom:var(--sn-space-lg);">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'scalernews' ); ?></a>
		<span class="sn-breadcrumbs__separator"> / </span>
		<?php
		if ( is_category() || is_single() ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				echo '<span class="sn-breadcrumbs__separator"> / </span>';
			}
		}

		if ( is_single() || is_page() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html( get_the_title() ) . '</span>';
		} elseif ( is_category() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html( single_cat_title( '', false ) ) . '</span>';
		} elseif ( is_tag() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html( single_tag_title( '', false ) ) . '</span>';
		} elseif ( is_author() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html( get_the_author() ) . '</span>';
		} elseif ( is_search() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html__( 'Search Results', 'scalernews' ) . '</span>';
		} elseif ( is_404() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html__( '404 Not Found', 'scalernews' ) . '</span>';
		} elseif ( is_archive() ) {
			echo '<span class="sn-breadcrumbs__current">' . esc_html( get_the_archive_title() ) . '</span>';
		}
		?>
	</nav>
	<?php
}
add_action( 'scalernews_before_content', 'scalernews_breadcrumbs' );

/**
 * Display the posted-on date.
 */
function scalernews_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display the post author.
 */
function scalernews_posted_by() {
	printf(
		'<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Display social share buttons for single posts.
 */
function scalernews_social_share_buttons() {
	if ( ! is_single() ) {
		return;
	}

	$url   = urlencode( get_the_permalink() );
	$title = urlencode( get_the_title() );
	?>
	<div class="sn-social-share" style="display:flex;gap:var(--sn-space-sm);align-items:center;margin-top:var(--sn-space-xl);padding-top:var(--sn-space-lg);border-top:1px solid var(--sn-color-gray-200);">
		<span style="font-weight:600;font-size:var(--sn-text-sm);margin-right:var(--sn-space-sm);"><?php esc_html_e( 'Share:', 'scalernews' ); ?></span>
		<a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>"
		   target="_blank" rel="noopener noreferrer"
		   aria-label="<?php esc_attr_e( 'Share on Twitter', 'scalernews' ); ?>"
		   style="background:var(--sn-color-gray-100);padding:var(--sn-space-sm);border-radius:50%;display:inline-flex;">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
		</a>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
		   target="_blank" rel="noopener noreferrer"
		   aria-label="<?php esc_attr_e( 'Share on Facebook', 'scalernews' ); ?>"
		   style="background:var(--sn-color-gray-100);padding:var(--sn-space-sm);border-radius:50%;display:inline-flex;">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
		</a>
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
		   target="_blank" rel="noopener noreferrer"
		   aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'scalernews' ); ?>"
		   style="background:var(--sn-color-gray-100);padding:var(--sn-space-sm);border-radius:50%;display:inline-flex;">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
		</a>
	</div>
	<?php
}
add_action( 'scalernews_single_post_footer', 'scalernews_social_share_buttons', 10 );
