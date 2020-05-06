<?php

/**
 *
 * サイトURLのショートコード登録
 */

add_shortcode( 'url', 'shortcode_url' );

function shortcode_url() {
	return get_bloginfo( 'url' );
}

/**
 *
 * 親テーマショートコード登録
 */

add_shortcode( 'template_url', 'shortcode_template_url' );

function shortcode_template_url() {
	return get_template_directory_uri();
}

/**
 *
 * 子テーマショートコード登録
 */

add_shortcode( 'template_child_url', 'shortcode_template_child_url' );

function shortcode_template_child_url() {
	return get_stylesheet_directory_uri();
}
