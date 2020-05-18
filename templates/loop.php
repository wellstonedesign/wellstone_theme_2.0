<?php
/**
 * Theme loop
 *
 * Theme loop for the theme.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

?>
							<?php if ( have_posts() ) : ?>
							<ul class="index-post-list">
								<?php while ( have_posts() ) : ?>
									<?php the_post(); ?>
									<li class="index-post-list__item">
										<figure class="index-post-list__figure">
											<a class="index-post-list__image-link" href="<?php the_permalink( '' ); ?>"><?php theme_the_thumbnail(); ?></a>
										</figure>
										<div class="index-post-list__info">
											<time class="index-post-list__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
											<div class="index-post-list__category"><?php the_category(); ?></div>
											<h3 class="index-post-list__title"><a class="index-post-list__link" href="<?php the_permalink( '' ); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), 60, '...' ) ); ?></a></h3>
											<p class="index-post-list__description"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 120, '...' ) ); ?></p>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
							<?php else : ?>
								<ul class="news-area-list">
									<li class="news-area-list__item"><span class="news-area-list__no-post">まだ投稿はありません。</span></li>
								</li>
							<?php endif; ?>
