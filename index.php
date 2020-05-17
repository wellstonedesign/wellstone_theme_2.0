<?php
/**
 * Theme index
 *
 * Theme index for the theme.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

?>
		<?php get_header(); ?>
		<div class="mainvisual"></div>
		<main>
			<div class="index-section">
				<div class="index-section__inner">
					<article class="index-post">
							<div class="index-post__inner">
							<header class="index-post__header animated" data-animate="fadeIn">
								<h2 class="index-post__title">LATEST POSTS</h2>
							</header>
							<?php get_template_part( 'templates/loop' ); ?>
						</div>
					</article>
				</div>
				<div class="pager">
					<?php theme_the_pager(); ?>
				</div>
			</div>
		</main>
		<?php get_footer(); ?>
