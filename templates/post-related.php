<?php
/**
 * Theme related post
 *
 * 関連記事を表示する.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

?>
<aside class="post-related">
	<div class="post-related__inner">
		<h2 class="post-related__title">RELATED POSTS</h2>
		<ul class="post-related-list">
			<?php $query = new WP_Query( theme_get_related_post_args( 8 ) ); ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<li class="post-related-list__item">
						<figure class="post-related-list__figure">
							<a class="post-related-list__image-link" href="<?php the_permalink( '' ); ?>"><?php theme_the_thumbnail(); ?></a>
						</figure>
						<div class="post-related-list__info">
							<time class="post-related-list__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
							<h3 class="post-related-list__title"><a class="post-related-list__link" href="<?php the_permalink( '' ); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), 48, '...' ) ); ?></a></h3>
						</div>
					</li>
				<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>
</aside>
