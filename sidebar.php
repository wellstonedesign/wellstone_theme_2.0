<div class="sidebar js-toggle-state">
	<nav class="site-nav">
		<?php wp_nav_menu( array( 'menu' => 'global-nav', 'theme_location' => 'global-nav' ) ); ?>
	</nav>
	<aside class="sidebar-category">
		<h2 class="sidebar__title">CATEGORY</h2>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</aside>
	<aside class="sidebar-tag">
		<h2 class="sidebar__title">TAG</h2>
		<?php wp_tag_cloud( 'smallest=11&largest=11&unit=px' ); ?>
	</aside>
</div>
