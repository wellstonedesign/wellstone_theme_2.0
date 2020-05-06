<?php

/**
 * カスタムフィールドの追加
 * noindex,nofollow設定
 */

// 固定カスタムフィールドボックス
function theme_add_seo_fields() {
  $post_type = array( 'post', 'page' );

  add_meta_box( 'seo_setting', 'SEO設定', 'theme_insert_seo_fields', $post_type, 'normal' );
}
add_action( 'admin_menu', 'theme_add_seo_fields' );

// カスタムフィールドの入力エリア
function theme_insert_seo_fields() {
  global $post;

  if( get_post_meta( $post->ID, 'check_noindex', true ) == "is-on" ) {
    $check_noindex = 'checked';
  } else {
    $check_noindex = '';
  }
  echo 'noindex,nofollow設定： <input type="checkbox" name="check_noindex" value="is-on" ' . $check_noindex . ' ><br>';
}

// カスタムフィールドの値を保存
function theme_save_seo_fields( $post_id ) {

  if( !empty( $_POST['check_noindex'] ) ) {
    update_post_meta( $post_id, 'check_noindex', $_POST['check_noindex'] );
  }else{
    delete_post_meta( $post_id, 'check_noindex' );
  }
}
add_action('save_post', 'theme_save_seo_fields');
