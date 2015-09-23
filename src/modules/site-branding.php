<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : September 24, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>

<?php do_action( 'habakiri_before_site_branding' ); ?>
<div class="site-branding">
	<h1 class="site-branding__heading">
		<?php get_template_part( 'modules/logo' ); ?>
	</h1>
<!-- end .site-branding --></div>
<?php do_action( 'habakiri_after_site_branding' ); ?>
