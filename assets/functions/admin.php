<?php
/**
 * Theme functions
 *
 * 管理画面カスタマイズ
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 *
 * 管理画面の項目を削除
 */
function remove_menus() {
	// remove_menu_page( 'index.php' ); // ダッシュボード.
	// remove_menu_page( 'edit.php' ); // 投稿.
	// remove_menu_page( 'upload.php' ); // メディア.
	// remove_menu_page( 'edit.php?post_type=page' ); // 固定ページ.
	remove_menu_page( 'edit-comments.php' ); // コメント.
	// remove_menu_page( 'themes.php' ); // 外観.
	// remove_menu_page( 'plugins.php' ); // プラグイン.
	// remove_menu_page( 'users.php' ); // ユーザー.
	// remove_menu_page( 'tools.php' ); // ツール.
	// remove_menu_page( 'options-general.php' ); // 設定.
}
add_action( 'admin_menu', 'remove_menus' );

/**
 *
 * 管理バーの項目を削除
 *
 * @param array $wp_admin_bar .
 */
function remove_bar_menus( $wp_admin_bar ) {
	// $wp_admin_bar->remove_menu( 'wp-logo' ); // WordPress ロゴ.
	// $wp_admin_bar->remove_menu( 'site-name' ); // サイト名.
	// $wp_admin_bar->remove_menu( 'view-site' ); // サイト名 -> サイトを表示.
	$wp_admin_bar->remove_menu( 'comments' ); // コメント.
	// $wp_admin_bar->remove_menu( 'new-content' ); // 新規.
	// $wp_admin_bar->remove_menu( 'new-post' ); // 新規 -> 投稿.
	// $wp_admin_bar->remove_menu( 'new-media' ); // 新規 -> メディア.
	// $wp_admin_bar->remove_menu( 'new-link' ); // 新規 -> リンク.
	// $wp_admin_bar->remove_menu( 'new-page' ); // 新規 -> 固定ページ.
	// $wp_admin_bar->remove_menu( 'new-user' ); // 新規 -> ユーザー.
	// $wp_admin_bar->remove_menu( 'updates' ); // 更新.
	// $wp_admin_bar->remove_menu( 'my-account' ); // マイアカウント.
	// $wp_admin_bar->remove_menu( 'user-info' ); // マイアカウント -> プロフィール.
	// $wp_admin_bar->remove_menu( 'edit-profile') ; // マイアカウント -> プロフィール編集.
	// $wp_admin_bar->remove_menu( 'logout' ); // マイアカウント -> ログアウト.
}
add_action( 'admin_bar_menu', 'remove_bar_menus', 201 );

/**
 *
 * ダッシュボードの項目を削除
 */
function remove_dashboard_widget() {
	remove_action( 'welcome_panel', 'wp_welcome_panel' ); // ようこそ.
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要.
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース.
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widget' );

/**
 *
 * メニューの追加
 */
function menu_setup() {
	register_nav_menus(
		array(
			'global-nav' => 'グローバルメニュー',
			'footer-nav' => 'フッターメニュー',
		)
	);
}
add_action( 'after_setup_theme', 'menu_setup' );

/**
 *
 * 管理画面の「WordPressのご利用ありがとうございます。」を削除
 */
add_filter( 'admin_footer_text', '__return_empty_string' );

/**
 *
 * リビジョン保存数を変更
 *
 * @param int $num .
 */
function set_revision_store_number( $num ) {
	return 10;
}
add_filter( 'wp_revisions_to_keep', 'set_revision_store_number' );

/**
 *
 * 固定ページに抜粋項目を追加する
 */
add_post_type_support( 'page', 'excerpt' );

/**
 *
 * カスタムサムネイルの追加
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'thumbnail-large', 300, 300, true );
