<?php
/**
 * Version    : 1.1.3
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article article--search">
	<div class="entry">
		<div class="entry__content entry-content">
			<div class="entries entries--archive entries-archive">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'summary' ); ?>
				<?php endwhile; ?>
			<!-- end .entries --></div>
		<!-- end .entry-content --></div>
		<?php Habakiri::the_pager(); ?>
	<!-- end .entry --></div>
</article>
