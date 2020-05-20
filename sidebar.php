<?php
/**
 * Theme sidebar
 *
 * Theme sidebar for the theme.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

?>

<div class="sidebar js-toggle-state">
	<nav class="site-nav">
		<?php
			wp_nav_menu(
				array(
					'menu'           => 'global-nav',
					'theme_location' => 'global-nav',
				)
			);
			?>
	</nav>
	<aside class="sidebar-category">
		<h2 class="sidebar__title">CATEGORY</h2>
		<ul>
			<?php wp_list_categories( 'title_li=' ); ?>
		</ul>
	</aside>
</div>
