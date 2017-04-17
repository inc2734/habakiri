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

$theme_url     = 'http://2inc.org';
$wordpress_url = 'http://wordpress.org/';

$theme_link = sprintf(
	'<a href="%s" target="_blank">%s</a>',
	esc_url( $theme_url ),
	__( 'Monkey Wrench', 'habakiri' )
);

$wordpress_link = sprintf(
	'<a href="%s" target="_blank">%s</a>',
	esc_url( $wordpress_url ),
	__( 'WordPress', 'habakiri' )
);

$theme_by   = sprintf( __( 'Habakiri theme by %s', 'habakiri' ), $theme_link );
$powered_by = sprintf( __( 'Powered by %s', 'habakiri' ), $wordpress_link );
$copyright  = sprintf(
	'%s&nbsp;%s',
	$theme_by,
	$powered_by
);

echo apply_filters( 'habakiri_copyright', $copyright );
