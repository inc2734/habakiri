<?php
/**
 * Version    : 1.3.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : July 5, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article article--search">
	<div class="entry">
		<div class="entry__content">
			<div class="entries entries--search">
				<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( array( 'article' ) ); ?>>
					<div class="entry">
						<?php Habakiri::the_title(); ?>
						<div class="entry__summary">
							<?php the_excerpt(); ?>
						<!-- end .entry__summary --></div>
					<!-- end .entry --></div>
				</article>
				<?php endwhile; ?>
			<!-- end .entries --></div>
		<!-- end .entry__content --></div>
		<?php get_template_part( 'modules/pagination' ); ?>
	<!-- end .entry --></div>
</article>
