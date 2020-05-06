		<?php get_header(); ?>
		<main>
			<article class="single-section">
				<div class="single-section__inner">
				<?php while ( have_posts() ) : the_post(); ?>
					<header class="single-header">
						<div class="single-header__inner">
							<h1 class="single-header__title"><?php the_title(); ?></h1>
						</div>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<footer class="single-post__meta-area">
						<time class="single-post__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
						<div class="single-post__category"><?php the_category(); ?></div>
						<div class="single-post__tag"><?php the_tags( '', '' ); ?></div>
					</footer>
				</div>
				<?php endwhile; ?>
			</article>
		</main>
		<?php get_template_part( 'templates/post', 'related' ); ?>
		<?php get_template_part( 'templates/breadcrumb' ); ?>
		<?php get_footer(); ?>
