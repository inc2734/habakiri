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

require_once get_template_directory() . '/inc/class.bread-crumb.php';

if ( !is_front_page() ) {
	$Bread_Crumb = new Habakiri_Bread_Crumb();
	$Bread_Crumb->display();
}
