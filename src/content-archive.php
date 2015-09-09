<?php
/**
 * Version    : 1.2.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article article--archive">
	<div class="entry">
		<div class="entry__content">
			<div class="entries entries--archive">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'summary' ); ?>
				<?php endwhile; ?>
			<!-- end .entries --></div>
		<!-- end .entry__content --></div>
		<?php get_template_part( 'modules/pagination' ); ?>
	<!-- end .entry --></div>
</article>
