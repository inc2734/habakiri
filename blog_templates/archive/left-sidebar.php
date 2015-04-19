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
		<div class="col-md-9 col-md-push-3">
			<main id="main" role="main">
				<div class="entries">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content' ); ?>
					<?php endwhile; ?>
				<!-- end .entries --></div>
				<?php Habakiri::the_pager(); ?>
			<!-- end #main --></main>
		<!-- end .col-md-9 --></div>
		<div class="col-md-3 col-md-pull-9">
			<?php get_sidebar(); ?>
		<!-- end .col-md-3 --></div>
	<!-- end .row --></div>
<!-- end .container --></div>