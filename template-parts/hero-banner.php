<?php
/**
 * Template part for the hero banner on the front page
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_count = get_theme_mod( 'scalernews_hero_count', 3 );
$hero_args  = array(
	'posts_per_page' => $hero_count,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query'     => array(
		array(
			'key'   => '_thumbnail_id',
			'compare' => 'EXISTS',
		),
	),
);

// Optionally use a featured category.
$hero_category = get_theme_mod( 'scalernews_hero_category', '' );
if ( ! empty( $hero_category ) ) {
	$hero_args['cat'] = $hero_category;
}

$hero_query = new WP_Query( $hero_args );

if ( ! $hero_query->have_posts() ) {
	// Fallback: get latest posts even without thumbnails.
	$hero_query = new WP_Query( array(
		'posts_per_page' => $hero_count,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );
}

if ( $hero_query->have_posts() ) :
	$hero_posts = array();
	while ( $hero_query->have_posts() ) {
		$hero_query->the_post();
		$hero_posts[] = array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'permalink' => get_permalink(),
			'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'scalernews-hero' ),
			'excerpt'   => get_the_excerpt(),
			'category'  => get_the_category(),
			'date'      => get_the_date(),
			'author'    => get_the_author(),
		);
	}
	wp_reset_postdata();
?>

<section class="sn-hero" aria-label="<?php esc_attr_e( 'Featured Stories', 'scalernews' ); ?>">
	<?php if ( isset( $hero_posts[0] ) ) : ?>
	<!-- Main Hero Post -->
	<div class="sn-hero__main">
		<?php if ( $hero_posts[0]['thumbnail'] ) : ?>
			<img src="<?php echo esc_url( $hero_posts[0]['thumbnail'] ); ?>"
				 alt="<?php echo esc_attr( $hero_posts[0]['title'] ); ?>"
				 loading="eager">
		<?php endif; ?>
		<div class="sn-hero__main-overlay">
			<?php if ( ! empty( $hero_posts[0]['category'] ) ) : ?>
				<a class="sn-post-card__category" href="<?php echo esc_url( get_category_link( $hero_posts[0]['category'][0]->term_id ) ); ?>">
					<?php echo esc_html( $hero_posts[0]['category'][0]->name ); ?>
				</a>
			<?php endif; ?>
			<h2><a href="<?php echo esc_url( $hero_posts[0]['permalink'] ); ?>"><?php echo esc_html( $hero_posts[0]['title'] ); ?></a></h2>
			<p style="color:rgba(255,255,255,0.8);font-size:var(--sn-text-sm);margin-top:var(--sn-space-sm);">
				<?php echo esc_html( wp_trim_words( $hero_posts[0]['excerpt'], 20 ) ); ?>
			</p>
			<span style="color:rgba(255,255,255,0.6);font-size:var(--sn-text-xs);margin-top:var(--sn-space-sm);display:inline-block;">
				<?php echo esc_html( $hero_posts[0]['date'] ); ?> &middot; <?php echo esc_html( $hero_posts[0]['author'] ); ?>
			</span>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( count( $hero_posts ) > 1 ) : ?>
	<!-- Side Posts -->
	<div class="sn-hero__side">
		<?php for ( $i = 1; $i < count( $hero_posts ); $i++ ) : ?>
		<div class="sn-hero__side-item">
			<?php if ( $hero_posts[ $i ]['thumbnail'] ) : ?>
				<img src="<?php echo esc_url( $hero_posts[ $i ]['thumbnail'] ); ?>"
					 alt="<?php echo esc_attr( $hero_posts[ $i ]['title'] ); ?>"
					 loading="eager">
			<?php endif; ?>
			<div class="sn-hero__side-overlay">
				<?php if ( ! empty( $hero_posts[ $i ]['category'] ) ) : ?>
					<a class="sn-post-card__category" href="<?php echo esc_url( get_category_link( $hero_posts[ $i ]['category'][0]->term_id ) ); ?>" style="font-size:0.65rem;padding:1px 8px;">
						<?php echo esc_html( $hero_posts[ $i ]['category'][0]->name ); ?>
					</a>
				<?php endif; ?>
				<h3><a href="<?php echo esc_url( $hero_posts[ $i ]['permalink'] ); ?>"><?php echo esc_html( $hero_posts[ $i ]['title'] ); ?></a></h3>
			</div>
		</div>
		<?php endfor; ?>
	</div>
	<?php endif; ?>
</section>

<?php endif; ?>
