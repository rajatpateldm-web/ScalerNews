<?php
/**
 * Template part for displaying a reusable news post card
 *
 * Used in front-page.php and other custom sections.
 * Similar to content.php but designed for featured sections.
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sn-post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="sn-post-card__thumbnail">
		<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'scalernews-card' ); ?>
		</a>
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) :
		?>
			<a class="sn-post-card__category" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
				<?php echo esc_html( $categories[0]->name ); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="sn-post-card__body">
		<h3 class="sn-post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="sn-post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<div class="sn-post-card__meta">
			<span class="sn-post-card__meta-item">
				<?php echo esc_html( get_the_author() ); ?>
			</span>
			<span class="sn-post-card__meta-item">
				<?php echo esc_html( get_the_date() ); ?>
			</span>
			<span class="sn-post-card__meta-item sn-reading-time">
				<?php echo esc_html( scalernews_reading_time() ); ?>
			</span>
		</div>
	</div>
</article>
