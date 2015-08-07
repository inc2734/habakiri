<?php
/**
 * Version    : 1.2.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 31, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<div class="container">
	<main id="main" role="main">
		<?php Habakiri::the_bread_crumb(); ?>
		<?php
		if ( is_404() ) {
			get_template_part( 'content', 'none' );
		} else {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'single' );
			}
		}
		?>
	<!-- end #main --></main>
	
	<?php get_sidebar(); ?>
<!-- end .container --></div>