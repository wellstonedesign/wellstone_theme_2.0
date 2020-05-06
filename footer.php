	<footer class="site-footer">
		<div class="site-footer__inner">
			<div class="sns-menu">
				<ul class="sns-menu-list">
					<li class="sns-menu-list__item">
						<a class="sns-menu-list__link" href="https://twitter.com/hideyuki_ishii" target="_blank" rel="noopener" aria-label="ツイッターアカウントを見る">
							<svg class="sns-menu-list__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
								<path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
							</svg>
						</a>
					</li>
					<li class="sns-menu-list__item">
						<a class="sns-menu-list__link" href="https://www.facebook.com/hideyuki.ishii.f" target="_blank" rel="noopener" aria-label="フェイスブックアカウントを見る">
							<svg class="sns-menu-list__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512">
								<path fill="currentColor" d="M215.8 85H264V3.6C255.7 2.5 227.1 0 193.8 0 124.3 0 76.7 42.4 76.7 120.3V192H0v91h76.7v229h94V283h73.6l11.7-91h-85.3v-62.7c0-26.3 7.3-44.3 45.1-44.3z"></path>
							</svg>
						</a>
					</li>
					<li class="sns-menu-list__item">
						<a class="sns-menu-list__link" href="https://www.instagram.com/hideyuki.ishii.in/" target="_blank" rel="noopener" aria-label="インスタグラムアカウントを見る">
							<svg class="sns-menu-list__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
							</svg>
						</a>
					</li>
				</ul>
			</div>
			<div class="site-footer__menu">
				<?php wp_nav_menu( array('menu' => 'footer-nav', 'theme_location' => 'footer-nav')); ?>
			</div>
			<p class="site-footer__copy">&copy; WELLSTONE.design All Rights Reserved.</p>
		</div>
	</footer>
<?php get_sidebar(); ?>
<script src="<?php theme_get_parent_theme_url() ?>/assets/js/jquery-3.4.1.min.js"></script>
<script src="<?php theme_get_parent_theme_url() ?>/assets/js/jquery.easing.1.3.js"></script>
<script src="<?php theme_get_parent_theme_url() ?>/assets/js/jquery.inview.min.js"></script>
<script src="<?php theme_get_parent_theme_url() ?>/assets/js/jquery.main.js"></script>
<script src="<?php theme_get_parent_theme_url() ?>/assets/js/main.js"></script>
<?php wp_footer(); ?>
</body>
</html>
