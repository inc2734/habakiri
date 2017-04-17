<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : September 9, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */

wp_link_pages( array(
	'before'           => '<nav><ul class="pagination"><li>',
	'after'            => '</li></ul></nav>',
	'link_before'      => '',
	'link_after'       => '',
	'separator'        => '</li><li>',
	'nextpagelink'     => '&gt;',
	'previouspagelink' => '%lt;',
	'pagelink'         => '<span>%</span>',
) );
