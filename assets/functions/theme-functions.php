<?php
/**
 * Theme functions
 *
 * Theme functions for the theme.
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 *
 * スクリプトファイルの読み込み
 */
function theme_enqueue_scripts() {
	// WordPress本体のjquery.jsを読み込まない.
	wp_deregister_script( 'jquery' );

	wp_register_script(
		'google_analytics',
		get_stylesheet_directory_uri() . '/assets/js/analytics.js',
		false,
		'1.1',
		false,
	);
	wp_enqueue_script( 'google_analytics' );

	wp_enqueue_script(
		'jquery',
		get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js',
		'',
		'1.1',
		'true',
	);
	wp_enqueue_script(
		'jquery_easing',
		get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js',
		'jquery',
		'1.1',
		'true',
	);
	wp_enqueue_script(
		'jquery_inview',
		get_template_directory_uri() . '/assets/js/jquery.inview.min.js',
		'jquery',
		'1.1',
		'true',
	);
	wp_enqueue_script(
		'jquery_main',
		get_template_directory_uri() . '/assets/js/jquery.main.js',
		array(
			'jquery',
			'jquery_easing',
			'jquery_inview',
		),
		'1.1',
		'true',
	);
	wp_enqueue_script(
		'lazyload',
		get_template_directory_uri() . '/assets/js/lazysizes.min.js',
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
		'1.1',
	);
	wp_enqueue_style(
		'font_noto',
		'https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500&display=swap&subset=japanese',
		'',
		'1.1',
	);
	wp_enqueue_style(
		'font_barlow',
		'https://fonts.googleapis.com/css2?family=Barlow+Condensed&display=swap',
		'',
		'1.1',
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 *
 * タイトルの表示　
 */
function theme_get_the_title() {
	$site_name = get_bloginfo( 'name' );

	if ( is_front_page() ) {
		$title = $site_name;
		echo esc_html( $title );
	} else {
		$title = wp_title( '' ) . ' | ' . $site_name;
		echo esc_html( $title );
	}
}

/**
 *
 * ループ外で抜粋を取得する
 */
function theme_get_the_excerpt() {
	global $post;
	$content = $post->post_content;
	$content = str_replace( array( "\r\n", "\r", "\n", '&nbsp;' ), '', $content );
	$content = wp_strip_all_tags( $content );
	$content = preg_replace( '/\[.*\]/', '', $content );
	return $content;
}

/**
 *
 * ディスクリプションの表示
 */
function theme_get_the_description() {
	global $post;
	$site_desc = get_bloginfo( 'description' );
	$excerpt   = $post->post_excerpt;

	if ( ! $excerpt ) {
		$excerpt = theme_get_the_excerpt();
		$excerpt = mb_substr( $excerpt, 0, 300 );
	}

	if ( is_front_page() ) {
		echo esc_html( $site_desc );
	} elseif ( is_page() || is_single() ) {
		echo esc_html( $excerpt );
	} else {
		echo esc_html( $site_desc );
	}
}

/**
 *
 * OGP表示
 */
function theme_get_the_ogp() {

	theme_get_the_og_title();

	theme_get_the_og_description();

	theme_get_the_og_url();

	theme_get_the_og_image();
}

/**
 *
 * OGタイトルを取得
 */
function theme_get_the_og_title() {
	echo '<meta property="og:title" content="';
	theme_get_the_title();
	echo '">';
	echo "\n";
}

/**
 *
 * OGディスクリプションを取得
 */
function theme_get_the_og_description() {
	echo '<meta property="og:description" content="';
	theme_get_the_description();
	echo '">';
	echo "\n";
}

/**
 *
 * OG URLを取得
 */
function theme_get_the_og_url() {
	if ( is_single() || is_page() ) {
		echo '<meta property="og:url" content="';
		the_permalink();
		echo '">';
		echo "\n";
	} else {
		echo '<meta property="og:url" content="';
		bloginfo( 'url' );
		echo '">';
		echo "\n";
	}
}

/**
 *
 * OGイメージを取得する
 */
function theme_get_the_og_image() {
	global $post;
	$post_content         = $post->post_content;
	$search_image_pattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i'; // 投稿記事に画像があるか.

	if ( is_single() || is_page() ) {
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id();
			$image    = wp_get_attachment_image_src( $image_id, 'full' );
			echo '<meta property="og:image" content="' . esc_html( $image[0] ) . '">';
			echo "\n";
		} elseif ( preg_match( $search_image_pattern, $post_content, $imgurl ) && ! is_archive() ) {
			echo '<meta property="og:image" content="' . esc_html( $imgurl[2] ) . '">';
			echo "\n";
		} else {
			echo '<meta property="og:image" content="' . esc_html( get_template_directory_uri() ) . '/assets/img/ogimage.jpg">';
			echo "\n";
		}
	} else {
		echo '<meta property="og:image" content="' . esc_html( get_template_directory_uri() ) . '/assets/img/ogimage.jpg">';
		echo "\n";
	}
}

/**
 *
 * 親テーマのURLを出力する
 */
function theme_get_parent_theme_url() {
	echo esc_url( get_template_directory_uri() );
}

/**
 *
 * 子テーマのURLを出力する
 */
function theme_get_child_theme_url() {
	echo esc_url( get_stylesheet_directory_uri() );
}

/**
 *
 * 記事内画像をサムネイルにする
 */
function theme_the_thumbnail() {
	if ( has_post_thumbnail() ) {
		global $post;
		$thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
		echo '<img class="lazyload" data-src="' . esc_url( $thumbnail_url ) . '" alt="">';
	} else {
		echo '<img class="lazyload" data-src="' . esc_url( theme_get_the_post_thumbnail_url() ) . '" alt="">';
	}
}

/**
 *
 * 記事内画像のURLを取得する
 */
function theme_get_the_post_thumbnail_url() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

	if ( $output ) {
		$first_img = $matches[1][0];
	}

	if ( empty( $first_img ) ) {
		// 記事内で画像ない場合はデフォルト画像を表示.
		$first_img = esc_url( get_stylesheet_directory_uri() ) . '/assets/img/default.png';
	}
	return $first_img;
}

/**
 *
 * ページネーション関数
 */
function theme_the_pager() {
	$big  = 999999999; // need an unlikely integer.
	$args = array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'prev_text' => __( '&laquo;' ),
		'next_text' => __( '&raquo;' ),
	);
	echo wp_kses_post( paginate_links( $args ) );
}

/**
 *
 * 次の投稿記事のリンクを取得
 */
function theme_next_post_link() {
	$next_post = get_next_post();
	if ( ! empty( $next_post ) ) {
		echo wp_kses_post( next_post_link( '%link' ) );
	}
}

/**
 *
 * 前の投稿記事のリンクを取得
 */
function theme_prev_post_link() {
	$prev_post = get_previous_post();
	if ( ! empty( $prev_post ) ) {
		echo wp_kses_post( previous_post_link( '%link' ) );
	}
}

/**
 *
 * ニュース投稿表示
 *
 * @param int    $no_of_list 投稿数.
 * @param string $post_type 投稿タイプ.
 */
function theme_get_post_args( $no_of_list, $post_type ) {
	// 先頭固定記事があると表示件数がオーバーしてしまう挙動を解消する.
	$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$list_count = $no_of_list;
	$sticky     = get_option( 'sticky_posts' );

	if ( ! empty( $sticky ) ) {
		$list_count -= count( $sticky );
	}
	return array(
		'paged'          => $paged,
		'posts_per_page' => $list_count,
		'post_type'      => $post_type,
	);
}

/**
 *
 * 関連記事表示
 *
 * @param int $no_of_list 投稿数.
 */
function theme_get_related_post_args( $no_of_list ) {
	global $post;
	$categories  = get_the_category( $post->ID );
	$category_id = array();

	foreach ( $categories as $category ) {
		array_push( $category_id, $category->cat_ID );
	}

	$args = array(
		'post__not_in'   => array( $post->ID ),
		'category__in'   => $category_id,
		'orderby'        => 'rand',
		'posts_per_page' => $no_of_list, // 表示するページ数.
	);

	return $args;
}

/**
 *
 * アーカイブタイトルを取得
 */
function theme_get_the_achive_title() {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} else {
		return '';
	}
	return $title;
}
