<?php
/**
 * Theme functions
 *
 * カスタムフィールドの設定
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 * 固定カスタムフィールドボックス.
 * noindex,nofollow設定
 */
function theme_add_seo_fields() {
	$post_type = array( 'post', 'page' );
	add_meta_box( 'seo_setting', 'SEO設定', 'theme_insert_seo_fields', $post_type, 'normal' );
}
add_action( 'admin_menu', 'theme_add_seo_fields' );

/**
 * カスタムフィールドの入力エリア.
 */
function theme_insert_seo_fields() {
	global $post;

	if ( get_post_meta( $post->ID, 'check_noindex', true ) === 'is-on' ) {
		$check_noindex = 'checked';
	} else {
		$check_noindex = '';
	}
	wp_nonce_field( 'nonce-seo', 'nonce-filed-seo' );
	echo '<label>noindex,nofollow設定： <input type="checkbox" name="check_noindex" value="is-on" ' . esc_html( $check_noindex ) . ' ><label>';
}

/**
 * カスタムフィールドの値を保存
 *
 * @param int $post_id post id.
 */
function theme_save_seo_fields( $post_id ) {
	$nonce = '';
	if ( ! empty( $_POST['nonce-filed-seo'] ) ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['nonce-filed-seo'] ) );
	}
	if ( wp_verify_nonce( $nonce, 'nonce-seo' ) ) {
		if ( ! empty( $_POST['check_noindex'] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST['check_noindex'] ) );
			update_post_meta( $post_id, 'check_noindex', $value );
		} else {
			delete_post_meta( $post_id, 'check_noindex' );
		}
	}
}
add_action( 'save_post', 'theme_save_seo_fields' );

/**
 *
 * Noindex, nofollow metaタグ追加
 */
function theme_display_noindex_meta() {
	global $post;

	if ( get_post_meta( $post->ID, 'check_noindex' ) ) {
		echo '<meta name="robots" content="noindex,nofollow">';
		echo "\n";
	} elseif ( is_archive() || is_404() ) {
		echo '<meta name="robots" content="noindex,nofollow">';
		echo "\n";
	}
}
add_action( 'wp_head', 'theme_display_noindex_meta' );
