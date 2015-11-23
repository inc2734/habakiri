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

if ( !is_front_page() ) {
	$Bread_Crumb = new Habakiri_Breadcrumbs();
	$Bread_Crumb->display();
}
