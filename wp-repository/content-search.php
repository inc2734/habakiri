<?php
/**
 * Version    : 1.4.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : July 5, 2015
 * Modified   : December 9, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article article--search">
	<div class="entry">
		<?php do_action( 'habakiri_before_entries' ); ?>
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
		<?php do_action( 'habakiri_after_entries' ); ?>
		
		<?php get_template_part( 'modules/pagination' ); ?>
	<!-- end .entry --></div>
</article>
