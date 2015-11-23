<?php
/**
 * Version    : 1.0.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : September 9, 2015
 * Modified   : December 9, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */

global $wp_rewrite;
global $wp_query;
global $paged;

$paginate_base = get_pagenum_link( 1 );
if ( strpos( $paginate_base, '?' ) || ! $wp_rewrite->using_permalinks() ) {
	$paginate_format = '';
	$paginate_base = add_query_arg( 'paged', '%#%' );
} else {
	$paginate_format = ( substr( $paginate_base, -1 ,1 ) == '/' ? '' : '/' ) .
	user_trailingslashit( 'page/%#%/', 'paged' );
	$paginate_base .= '%_%';
}

$paginate_links = paginate_links( array(
	'base'      => $paginate_base,
	'format'    => $paginate_format,
	'total'     => $wp_query->max_num_pages,
	'mid_size'  => 5,
	'current'   => ( $paged ? $paged : 1 ),
	'prev_text' => '&lt;',
	'next_text' => '&gt;',
	'type'      => 'array',
) );

if ( !$paginate_links ) {
	return;
}
?>
<nav class="pagination-wrapper">
	<ul class="pagination">
		<?php foreach ( $paginate_links as $link ) : ?>
		<li><?php echo $link; ?></li>
		<?php endforeach; ?>
	</ul>
</nav>
