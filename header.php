<?php
/**
 * Theme header
 *
 * Theme header for the theme.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

?>
<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="utf-8"> <title><?php theme_get_the_title(); ?></title>
<meta name="description" content="<?php theme_get_the_description(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width">
<meta name="author" content="WELLSTONE.design">
<link rel="canonical" href="https://wellstone.design">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145153086-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){ dataLayer.push( arguments ); }
gtag( 'js', new Date() );
gtag( 'config', 'UA-145153086-1' );
</script>

<!-- OGPの基本設定 -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@hideyuki_ishii">
<meta property="og:type" content="website" />
<?php theme_get_the_ogp(); ?>
<!-- /OGPの基本設定 -->

<?php wp_head(); ?>
</head>
<body>
	<header class="site-header">
		<div class="site-header__inner">
			<div class="site-logo">
				<a href="<?php bloginfo( 'url' ); ?>">
					<img class="lazyload" data-src="<?php theme_get_parent_theme_url(); ?>/assets/img/logo_wellstone.svg" alt="WELLSTONE.design">
				</a>
			</div>
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-header__description">
			<?php else : ?>
				<p class="site-header__description">
			<?php endif; ?>
					神奈川県川崎市にあるWEBサイト制作会社
			<?php if ( is_front_page() ) : ?>
				</h1>
			<?php else : ?>
				</p>
			<?php endif; ?>
		</div>
	</header>
	<div class="sp-global-menu-icon js-toggle-state">
		<div>
			<span></span> <span></span> <span></span>
		</div>
	</div>
	<div class="sp-global-menu-bg js-toggle-state"></div>
