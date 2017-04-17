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

if ( Habakiri::get( 'is_displaying_related_posts' ) === 'false' ) {
	return;
}

$RelatedPosts = new Habakiri_Related_Posts();
$RelatedPosts->display();
