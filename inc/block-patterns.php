<?php
/**
 * ScalerNews Block Patterns
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block pattern category.
 */
function scalernews_register_block_pattern_category() {
	register_block_pattern_category( 'scalernews', array(
		'label' => esc_html__( 'ScalerNews', 'scalernews' ),
	) );
}
add_action( 'init', 'scalernews_register_block_pattern_category' );

/**
 * Register block patterns.
 */
function scalernews_register_block_patterns() {

	// News Grid Pattern
	register_block_pattern( 'scalernews/news-grid', array(
		'title'       => esc_html__( 'News Grid', 'scalernews' ),
		'description' => esc_html__( 'A grid of latest posts displayed as news cards.', 'scalernews' ),
		'categories'  => array( 'scalernews' ),
		'content'     => '<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
<div class="wp-block-query">
	<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"bottom":"1.5rem"}}},"backgroundColor":"white"} -->
		<div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-bottom:1.5rem">
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px"}}}} /-->
			<!-- wp:group {"style":{"spacing":{"padding":{"left":"1.5rem","right":"1.5rem","top":"1rem"}}}} -->
			<div class="wp-block-group" style="padding-left:1.5rem;padding-right:1.5rem;padding-top:1rem">
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","fontStyle":"normal","fontWeight":"600","textTransform":"uppercase"}}} /-->
				<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"1.1rem","fontStyle":"normal","fontWeight":"700","lineHeight":"1.35"},"spacing":{"margin":{"top":"0.5rem","bottom":"0.5rem"}}}} /-->
				<!-- wp:post-date {"style":{"typography":{"fontSize":"0.8rem"},"color":{"text":"#6c757d"}}} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->',
	) );

	// Featured Story + Side Stories Pattern
	register_block_pattern( 'scalernews/featured-story', array(
		'title'       => esc_html__( 'Featured Story + Side Stories', 'scalernews' ),
		'description' => esc_html__( 'A large featured story with smaller stories on the side.', 'scalernews' ),
		'categories'  => array( 'scalernews' ),
		'content'     => '<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"1.5rem"}}}} -->
<div class="wp-block-columns">
	<!-- wp:column {"width":"60%"} -->
	<div class="wp-block-column" style="flex-basis:60%">
		<!-- wp:query {"queryId":2,"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
		<div class="wp-block-query">
			<!-- wp:post-template -->
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/10","style":{"border":{"radius":"12px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","fontStyle":"normal","fontWeight":"600","textTransform":"uppercase"},"spacing":{"margin":{"top":"1rem"}}}} /-->
				<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"1.8rem"}}} /-->
				<!-- wp:post-excerpt {"moreText":"","excerptLength":30} /-->
				<!-- wp:post-date {"style":{"color":{"text":"#6c757d"}}} /-->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:column -->
	<!-- wp:column {"width":"40%"} -->
	<div class="wp-block-column" style="flex-basis:40%">
		<!-- wp:query {"queryId":3,"query":{"perPage":3,"pages":0,"offset":1,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
		<div class="wp-block-query">
			<!-- wp:post-template -->
				<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"left":"1rem"}}}} -->
				<div class="wp-block-columns is-not-stacked-on-mobile">
					<!-- wp:column {"width":"40%"} -->
					<div class="wp-block-column" style="flex-basis:40%">
						<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","style":{"border":{"radius":"8px"}}} /-->
					</div>
					<!-- /wp:column -->
					<!-- wp:column {"width":"60%"} -->
					<div class="wp-block-column" style="flex-basis:60%">
						<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"1rem","fontStyle":"normal","fontWeight":"600"}}} /-->
						<!-- wp:post-date {"style":{"typography":{"fontSize":"0.8rem"},"color":{"text":"#6c757d"}}} /-->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->',
	) );

	// Newsletter Signup Pattern
	register_block_pattern( 'scalernews/newsletter-signup', array(
		'title'       => esc_html__( 'Newsletter Signup', 'scalernews' ),
		'description' => esc_html__( 'A newsletter signup call-to-action section.', 'scalernews' ),
		'categories'  => array( 'scalernews' ),
		'content'     => '<!-- wp:group {"style":{"color":{"background":"#1d3557","text":"#ffffff"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"3rem","right":"3rem","bottom":"3rem","left":"3rem"}}}} -->
<div class="wp-block-group has-text-color has-background" style="color:#ffffff;background-color:#1d3557;border-radius:12px;padding:3rem">
	<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"1.8rem"},"color":{"text":"#ffffff"}}} -->
	<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:1.8rem">Stay Updated with Breaking News</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ced4da"}}} -->
	<p class="has-text-align-center has-text-color" style="color:#ced4da">Get the latest news delivered straight to your inbox. No spam, unsubscribe anytime.</p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"primary","style":{"border":{"radius":"8px"}}} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" style="border-radius:8px">Subscribe Now</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
	) );
}
add_action( 'init', 'scalernews_register_block_patterns' );
