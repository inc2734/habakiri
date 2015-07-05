<?php
/**
 * Version    : 1.2.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 5, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php if ( is_single() ) : ?>

<article>
	<?php Habakiri::the_title(); ?>
	<?php Habakiri::the_entry_meta(); ?>
	<?php do_action( 'habakiri_before_entry_content' ); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	<!-- end .entry-content --></div>
	<?php do_action( 'habakiri_after_entry_content' ); ?>
	<?php Habakiri::the_link_pages(); ?>
	<?php Habakiri::the_related_posts(); ?>
	<?php
	if ( comments_open() || pings_open() || get_comments_number() ) {
		comments_template( '', true );
	}
	?>
</article>

<?php else : ?>

<article <?php post_class(); ?>>
	
	<?php if ( Habakiri::get( 'is_displaying_thumbnail' ) === 'false' ) : ?>

		<?php Habakiri::the_title(); ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		<!-- end .entry-summary --></div>
		<?php Habakiri::the_entry_meta(); ?>

	<?php else : ?>

		<div class="summary-with-thumbnail">
			<div class="summary-with-thumbnail-thumbnail">
				<?php Habakiri::the_post_thumbnail(); ?>
			<!-- end .media-left --></div>
			<div class="summary-with-thumbnail-body">
				<?php Habakiri::the_title(); ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				<!-- end .entry-summary --></div>
				<?php Habakiri::the_entry_meta(); ?>
			<!-- end .media-body --></div>
		<!-- end .media --></div>

	<?php endif; ?>

</article>

<?php endif; ?>