<?php
/**
 * Version    : 1.1.2
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : August 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php if ( have_posts() ) : ?>

	<div class="entries entries--archive entries-archive">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content' ); ?>
		<?php endwhile; ?>
	<!-- end .entries --></div>
	<?php Habakiri::the_pager(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>