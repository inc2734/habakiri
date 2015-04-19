<?php
/**
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<aside id="sub">
	<?php
	do_action( 'habakiri_before_sidebar_widget_area' );
	if ( is_active_sidebar( 'sidebar' ) ) {
		echo '<div class="sidebar">';
		dynamic_sidebar( 'sidebar' );
		echo '</div>';
	}
	do_action( 'habakiri_after_sidebar_widget_area' );
	?>
<!-- #sub --></aside>
