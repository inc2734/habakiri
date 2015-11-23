<?php
/**
 * Version    : 1.0.2
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 30, 2015
 * Modified   : October 23, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>

<?php do_action( 'habakiri_before_global_navigation' ); ?>
<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
<nav class="global-nav js-responsive-nav nav--hide" role="navigation">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'global-nav',
		'depth'          => 0,
	) );
	?>
<!-- end .global-nav --></nav>
<?php endif; ?>
<?php do_action( 'habakiri_after_global_navigation' ); ?>
