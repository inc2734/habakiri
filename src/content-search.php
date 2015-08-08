<?php
/**
 * Version    : 1.2.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : July 5, 2015
 * Modified   : August 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php if ( have_posts() ) : ?>

	<div class="entries entries--search">
		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( array( 'article' ) ); ?>>
			<div class="entry">
				<?php Habakiri::the_title(); ?>
				<div class="entry__summary entry-summary">
					<?php the_excerpt(); ?>
				<!-- end .entry-summary --></div>
			<!-- end .entry --></div>
		</article>
		<?php endwhile; ?>
	<!-- end .entries --></div>
	<?php Habakiri::the_pager(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>