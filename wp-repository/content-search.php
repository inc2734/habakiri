<?php
/**
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : July 5, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php if ( have_posts() ) : ?>

	<div class="entries">
		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<?php Habakiri::the_title(); ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			<!-- end .entry-summary --></div>
		</article>
		<?php endwhile; ?>
	<!-- end .entries --></div>
	<?php Habakiri::the_pager(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>