		<?php get_header(); ?>
		<div class="mainvisual"></div>
		<main>
			<article class="index-section">
				<div class="index-section__inner">
					<header class="index-post__header">
						<h2 class="index-post__title index-post__title--archive"><?php echo theme_get_the_achive_title(); ?></h2>
					</header>
					<section class="index-post">
							<div class="index-post__inner">
							<?php get_template_part('templates/loop'); ?>
						</div>
					</section>
				</div>
				<div class="pager">
					<?php theme_the_pager(); ?>
				</div>
			</article>
		</main>
		<?php get_footer(); ?>
