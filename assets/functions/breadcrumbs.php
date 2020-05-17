<?php
/**
 * Theme functions
 *
 * パンくずリスト生成
 *
 * @package    WordPress
 * @subpackage wellstone_theme
 */

/**
 *
 * パンくずリストの生成
 *
 * @param array $wp_obj .
 */
function theme_the_breadcrumb( $wp_obj = null ) {
	// トップページでは何も出力しない.
	if ( is_home() || is_front_page() ) {
		return false;
	}

	// そのページのWPオブジェクトを取得.
	if ( ! $wp_obj ) {
		$wp_obj = get_queried_object();
	}
	echo '<ul><li><a href="' . esc_url( home_url() ) . '">ホーム</a></li>';

	if ( is_attachment() ) {
		/**
		 * 添付ファイルページ ( $wp_obj : WP_Post )
		 * ※ 添付ファイルページでは is_single() も true になるので先に分岐
		 */
		$post_title = $wp_obj->post_title;
		echo '<li>' . esc_html( $post_title ) . '</li>';
	} elseif ( is_single() ) {
		/**
		 * 投稿ページ ( $wp_obj : WP_Post )
		 */
		$post_id    = $wp_obj->ID;
		$post_type  = $wp_obj->post_type;
		$post_title = $wp_obj->post_title;
		// カスタム投稿タイプかどうか.
		if ( 'post' !== $post_type ) {
			$the_tax = ''; // そのサイトに合わせ、投稿タイプごとに分岐させて明示的に指定してもよい.
			// 投稿タイプに紐づいたタクソノミーを取得 (投稿フォーマットは除く).
			$tax_array = get_object_taxonomies( $post_type, 'names' );
			foreach ( $tax_array as $tax_name ) {
				if ( 'post_format' !== $tax_name ) {
					$the_tax = $tax_name;
					break;
				}
			}
			// カスタム投稿タイプ名の表示.
			echo '<li><a href="' . esc_url( get_post_type_archive_link( $post_type ) ) . '">' . esc_html( get_post_type_object( $post_type )->label ) . '</a></li>';
		} else {
			$the_tax = 'category'; // 通常の投稿の場合、カテゴリーを表示.
		}
		// タクソノミーが紐づいていれば表示.
		if ( '' !== $the_tax ) {
			$child_terms  = array(); // 子を持たないタームだけを集める配列.
			$parents_list = array(); // 子を持つタームだけを集める配列.
			// 投稿に紐づくタームを全て取得.
			$terms = get_the_terms( $post_id, $the_tax );
			if ( ! empty( $terms ) ) {
				// 全タームの親IDを取得.
				foreach ( $terms as $term ) {
					if ( 0 !== $term->parent ) {
						$parents_list[] = $term->parent;
					}
				}
				// 親リストに含まれないタームのみ取得.
				foreach ( $terms as $term ) {
					if ( ! in_array( $term->term_id, $parents_list ) ) {
						$child_terms[] = $term;
					}
				}
				// 最下層のターム配列から一つだけ取得.
				$term = $child_terms[0];
				if ( 0 !== $term->parent ) {
					// 親タームのIDリストを取得.
					$parent_array = array_reverse( get_ancestors( $term->term_id, $the_tax ) );
					foreach ( $parent_array as $parent_id ) {
						$parent_term = get_term( $parent_id, $the_tax );
						echo '<li><a href="' . esc_url( get_term_link( $parent_id, $the_tax ) ) . '"><span>' . esc_html( $parent_term->name ) . '</span></a></li>';
					}
				}
				// 最下層のタームを表示.
				echo '<li><a href="' . esc_url( get_term_link( $term->term_id, $the_tax ) ) . '">' . esc_html( $term->name ) . '</a></li>';
			}
		}
		// 投稿自身の表示.
		echo '<li>' . esc_html( $post_title ) . '</li>';
	} elseif ( is_page() ) {
		/**
		 * 固定ページ ( $wp_obj : WP_Post )
		 */
		$page_id    = $wp_obj->ID;
		$page_title = $wp_obj->post_title;
		// 親ページがあれば順番に表示.
		if ( 0 !== $wp_obj->post_parent ) {
			$parent_array = array_reverse( get_post_ancestors( $page_id ) );
			foreach ( $parent_array as $parent_id ) {
				echo '<li><a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . esc_html( get_the_title( $parent_id ) ) . '</a></li>';
			}
		}
		// 投稿自身の表示.
		echo '<li>' . esc_html( $page_title ) . '</li>';
	} elseif ( is_post_type_archive() ) {
		/**
		 * 投稿タイプアーカイブページ ( $wp_obj : WP_Post_Type )
		 */
		echo '<li>' . esc_html( $wp_obj->label ) . '</li>';
	} elseif ( is_date() ) {
		/**
		 * 日付アーカイブ ( $wp_obj : null )
		 */
		$year  = get_query_var( 'year' );
		$month = get_query_var( 'monthnum' );
		$day   = get_query_var( 'day' );
		if ( 0 !== $day ) {
			// 日別アーカイブ.
			echo '<li><a href="' . esc_url( get_year_link( $year ) ) . '">' . esc_html( $year ) . '年</a></li>';
			echo '<li><a href="' . esc_url( get_month_link( $year, $month ) ) . '">' . esc_html( $month ) . '月</a></li>';
			echo '<li>' . esc_html( $day ) . '日</li>';
		} elseif ( 0 !== $month ) {
			// 月別アーカイブ.
			echo '<li><a href="' . esc_url( get_year_link( $year ) ) . '">' . esc_html( $year ) . '年</a></li><li>' . esc_html( $month ) . '月</li>';
		} else {
			// 年別アーカイブ.
			echo '<li>' . esc_html( $year ) . '年</li>';
		}
	} elseif ( is_author() ) {
		/**
		 * 投稿者アーカイブ ( $wp_obj : WP_User )
		 */
		echo '<li><span>' . esc_html( $wp_obj->display_name ) . ' の執筆記事</span></li>';
	} elseif ( is_archive() ) {
		/**
		 * タームアーカイブ ( $wp_obj : WP_Term )
		 */
		$term_id   = $wp_obj->term_id;
		$term_name = $wp_obj->name;
		$tax_name  = $wp_obj->taxonomy;
		// 親ページがあれば順番に表示.
		if ( 0 !== $wp_obj->parent ) {
			$parent_array = array_reverse( get_ancestors( $term_id, $tax_name ) );
			foreach ( $parent_array as $parent_id ) {
				$parent_term = get_term( $parent_id, $tax_name );
				echo '<li><a href="' . esc_html( get_term_link( $parent_id, $tax_name ) ) . '"><span>' . esc_html( $parent_term->name ) . '</span></a></li>';
			}
		}
		// ターム自身の表示.
		echo '<li><span>' . esc_html( $term_name ) . '</span></li>';
	} elseif ( is_search() ) {
		/**
		 * 検索結果ページ
		 */
		echo '<li><span>「' . esc_html( get_search_query() ) . '」で検索した結果</span></li>';

	} elseif ( is_404() ) {
		/**
		 * 404ページ
		 */
		echo '<li><span>お探しの記事は見つかりませんでした。</span></li>';
	} else {
		/**
		 * その他のページ
		 */
		echo '<li><span>' . esc_html( get_the_title() ) . '</span></li>';
	}
	echo '</ul></div>';
}
