<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 30, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */

if ( Habakiri::get( 'is_displaying_page_header' ) === 'false' ) {
	return;
}

$post_type         = get_post_type();
$post_type_object  = get_post_type_object( $post_type );
$custom_post_types = get_post_types( array(
	'_builtin' => false,
) );
$show_on_front  = get_option( 'show_on_front' );
$page_for_posts = get_option( 'page_for_posts' );

// ポストタイプ：投稿を表示を表示 + ブログ設定ではない
// 固定ページ、カスタム投稿タイプ、投稿 + Web サイト設定、404、検索
if ( $post_type !== 'post' || ( $show_on_front === 'page' && $page_for_posts ) ) {
	// 404, search
	if ( is_404() || is_search() ) {
		$Page_Header = new Habakiri_Page_Header();
	}
	// 階層を持つページ（ex: 固定ページ）
	elseif ( is_singular() && !empty( $post_type_object->hierarchical ) ) {
		$Page_Header = new Habakiri_Page_Header( get_the_ID() );
	}
	// ポストタイプ：投稿の場合
	elseif ( $post_type === 'post' ) {
		$Page_Header = new Habakiri_Page_Header( $page_for_posts );
	}
	// それ以外
	else {
		$Page_Header = new Habakiri_Page_Header();
	}
	$Page_Header->display();
}
