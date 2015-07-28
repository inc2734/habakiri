<?php
/**
 * Version    : 1.2.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : July 5, 2015
 * Modified   : July 28, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php if ( have_posts() ) : ?>

	<div class="entries entries-search">
		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<div class="entry">
				<?php Habakiri::the_title(); ?>
				<div class="entry-summary">
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