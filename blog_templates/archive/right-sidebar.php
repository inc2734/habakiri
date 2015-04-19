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
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<main id="main" role="main">

				<?php if ( have_posts() ) : ?>

					<div class="entries">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content' ); ?>
						<?php endwhile; ?>
					<!-- end .entries --></div>
					<?php Habakiri::the_pager(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
		
			<!-- end #main --></main>
		<!-- end .col-md-9 --></div>
		<div class="col-md-3">
			<?php get_sidebar(); ?>
		<!-- end .col-md-3 --></div>
	<!-- end .row --></div>
<!-- end .container --></div>