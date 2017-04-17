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

$header_logo = Habakiri::get( 'logo' );

if ( $header_logo ) {
	$header_logo = sprintf(
		'<img src="%s" alt="%s" class="site-branding__logo" />',
		esc_url( $header_logo ),
		get_bloginfo( 'name' )
	);
} else {
	$header_logo = get_bloginfo( 'name' );
}

printf(
	'<a href="%s" rel="home">%s</a>',
	esc_url( home_url( '/' ) ),
	$header_logo
);
