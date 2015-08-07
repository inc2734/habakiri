<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : 
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
		<?php do_action( 'habakiri_after_contents_content' ); ?>
	<!-- end #contents --></div>
	<footer id="footer">
		<?php do_action( 'habakiri_before_footer_content' ); ?>
		<div class="footer-widget-area">
			<div class="container">
				<div class="row">
					<?php
					if ( is_active_sidebar( 'footer-widget-area' ) ) {
						dynamic_sidebar( 'footer-widget-area' );
					}
					?>
				<!-- end .row --></div>
			<!-- end .container --></div>
		<!-- end .footer-widget-area --></div>

		<?php if ( has_nav_menu( 'social-nav' ) ) : ?>
		<div class="social-nav">
			<div class="container">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'social-nav',
					'fallback_cb'    => '',
					'depth'          => 1
				) );
				?>
			<!-- end .container --></div>
		<!-- end .social-nav --></div>
		<?php endif; ?>

		<div class="copyright">
			<div class="container">
				<?php Habakiri::the_copyright(); ?>
			<!-- end .container --></div>
		<!-- end .copyright --></div>
		<?php do_action( 'habakiri_after_footer_content' ); ?>
	<!-- end #footer --></footer>
<!-- end #container --></div>
<?php wp_footer(); ?>
</body>
</html>
