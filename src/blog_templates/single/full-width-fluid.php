<?php
/**
 * Version    : 1.2.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 31, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<div class="container-fluid">
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
<!-- end .container-fluid --></div>