<?php
/**
 * ScalerNews Template Functions
 *
 * Functions that enhance the theme by hooking into WordPress.
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function scalernews_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'scalernews_pingback_header' );


/**
 * Display related posts on single post pages.
 */
function scalernews_display_related_posts() {
	if ( ! is_single() ) {
		return;
	}

	$categories = get_the_category();
	if ( empty( $categories ) ) {
		return;
	}

	$category_ids = wp_list_pluck( $categories, 'term_id' );
	$related_args = array(
		'posts_per_page' => 3,
		'category__in'   => $category_ids,
		'post__not_in'   => array( get_the_ID() ),
		'orderby'        => 'rand',
	);
	$related_query = new WP_Query( $related_args );

	if ( $related_query->have_posts() ) :
	?>
	<section class="sn-related-posts" style="margin-top:var(--sn-space-2xl);padding-top:var(--sn-space-2xl);border-top:1px solid var(--sn-color-gray-200);">
		<div class="sn-section-heading">
			<h3 class="sn-section-heading__title"><?php esc_html_e( 'Related News', 'scalernews' ); ?></h3>
			<span class="sn-section-heading__line"></span>
		</div>
		<div class="sn-posts-grid">
			<?php
			while ( $related_query->have_posts() ) :
				$related_query->the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php
	endif;
}
add_action( 'scalernews_related_posts', 'scalernews_display_related_posts' );

/**
 * Modify the archive title to remove prefixes.
 */
function scalernews_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_year() ) {
		$title = get_the_date( 'Y' );
	} elseif ( is_month() ) {
		$title = get_the_date( 'F Y' );
	} elseif ( is_day() ) {
		$title = get_the_date( 'F j, Y' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'scalernews_archive_title' );

/**
 * Add schema.org markup for articles.
 */
function scalernews_article_schema() {
	if ( ! is_single() ) {
		return;
	}
	?>
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "NewsArticle",
		"headline": "<?php echo esc_js( get_the_title() ); ?>",
		"datePublished": "<?php echo esc_attr( get_the_date( 'c' ) ); ?>",
		"dateModified": "<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>",
		"author": {
			"@type": "Person",
			"name": "<?php echo esc_js( get_the_author() ); ?>"
		},
		"publisher": {
			"@type": "Organization",
			"name": "<?php echo esc_js( get_bloginfo( 'name' ) ); ?>"
		}
		<?php if ( has_post_thumbnail() ) : ?>
		,"image": "<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"
		<?php endif; ?>
	}
	</script>
	<?php
}
add_action( 'wp_head', 'scalernews_article_schema' );
