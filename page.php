		<?php get_header(); ?>
		<main>
			<article class="page-section">
				<div class="page-section__inner">
				<?php while ( have_posts() ) : the_post(); ?>
					<header class="page-header">
						<div class="page-header__inner">
							<h1 class="page-header__title"><?php the_title(); ?></h1>
						</div>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
				<?php endwhile; ?>
			</article>
		</main>
		<?php get_template_part( 'templates/breadcrumb' ); ?>
		<?php get_footer(); ?>
