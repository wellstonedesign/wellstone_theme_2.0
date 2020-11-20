<?php
/**
 * Theme functions
 *
 * ヘッダー出力カスタマイズ
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 *
 * スクリプトファイルの読み込み
 */
function theme_enqueue_scripts() {
	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/assets/js/main.js',
		'',
		filemtime( get_theme_file_path( '/assets/js/main.js' ) ),
		'true',
	);
	wp_enqueue_script(
		'lazyload',
		get_template_directory_uri() . '/assets/js/lazysizes.min.js',
		'',
		'1.1',
		'true',
	);
	wp_enqueue_script(
		'prism',
		get_template_directory_uri() . '/assets/js/prism.js',
		'',
		'1.1',
		'true',
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 *
 * スタイルファイルの読み込み
 */
function theme_enqueue_styles() {
	wp_enqueue_style(
		'style',
		get_template_directory_uri() . '/assets/css/style.css',
		'',
		gmdate( 'Ymd/Hi', filemtime( get_theme_file_path( '/assets/css/style.css' ) ) ),
	);
	wp_enqueue_style(
		'font_barlow',
		'https://fonts.googleapis.com/css2?family=Barlow+Condensed&text=ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&display=swap',
		'',
		'1.1',
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 *
 * ヘッダーの不要なタグを削除
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* マイクロソフトが開発したWindows Live Writer（ウインドウズ ライブ ライター）からの投稿を受け付けるための記述 */
remove_action( 'wp_head', 'rsd_link' );

/* EditURIは外部の投稿ツールからWordPressに記事の投稿を行う時に必要な設定 */
remove_action( 'wp_head', 'wlwmanifest_link' );

/* DNSプリフェッチを使用すると、外部ドメインでの名前解決を事前（Pre）に強制できるため表示速度を上げることができます。WordPressでは、絵文字をCDNしているドメインをプリフェッチしている設定があります。絵文字を使用しないのであれば、名前解決は不要 */
add_filter( 'emoji_svg_url', '__return_false' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* Version 4.4からのEmbed機能を使わない場合は削除 */
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

/* contact-form-7のCSSを削除 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_dequeue_style( 'contact-form-7' );
	}
);

/**
 *
 * [type='text/javascript']を削除し、[defer]を付与
 *
 * @param array $tag .
 */
function remove_script_type( $tag ) {
	return str_replace( "type='text/javascript'", 'defer', $tag );
}
add_filter( 'script_loader_tag', 'remove_script_type' );

/**
 *
 * [type='text/css']を削除
 *
 * @param array $tag .
 */
function remove_style_type( $tag ) {
	$tag = preg_replace(
		array(
			"| type='.+?'s*|",
			"| id='.+?'s*|",
			'| />|',
		),
		array(
			' ',
			' ',
			'>',
		),
		$tag
	);
	return $tag;
}
add_filter( 'style_loader_tag', 'remove_style_type' );
