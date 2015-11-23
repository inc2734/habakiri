<?php
/**
 * Version    : 1.3.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : November 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article article--archive">
	<div class="entry">
		<?php do_action( 'habakiri_before_entries' ); ?>
		<div class="entries entries--archive">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'summary' ); ?>
			<?php endwhile; ?>
		<!-- end .entries --></div>
		<?php do_action( 'habakiri_after_entries' ); ?>
			
		<?php get_template_part( 'modules/pagination' ); ?>
	<!-- end .entry --></div>
</article>
