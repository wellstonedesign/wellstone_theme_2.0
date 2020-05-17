<?php
/**
 * Theme functions
 *
 * ショートコードのカスタマイズ
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 *
 * サイトURLのショートコード登録
 */
function shortcode_url() {
	return get_bloginfo( 'url' );
}
add_shortcode( 'url', 'shortcode_url' );

/**
 *
 * 親テーマショートコード登録
 */
function shortcode_template_url() {
	return get_template_directory_uri();
}
add_shortcode( 'template_url', 'shortcode_template_url' );

/**
 *
 * 子テーマショートコード登録
 */
function shortcode_template_child_url() {
	return get_stylesheet_directory_uri();
}
add_shortcode( 'template_child_url', 'shortcode_template_child_url' );
