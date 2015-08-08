<?php
/**
 * Version    : 1.3.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php if ( is_single() ) : ?>

<article class="article">
	<div class="entry">
		<?php Habakiri::the_title(); ?>
		<?php Habakiri::the_entry_meta(); ?>
		<?php do_action( 'habakiri_before_entry_content' ); ?>
		<div class="entry__content entry-content">
			<?php the_content(); ?>
		<!-- end .entry-content --></div>
		<?php do_action( 'habakiri_after_entry_content' ); ?>
	<!-- end .entry --></div>
	
	<?php Habakiri::the_link_pages(); ?>
	<?php Habakiri::the_related_posts(); ?>
	<?php
	if ( comments_open() || pings_open() || get_comments_number() ) {
		comments_template( '', true );
	}
	?>
</article>

<?php else : ?>

<article <?php post_class( array( 'article' ) ); ?>>

	<?php if ( Habakiri::get( 'is_displaying_thumbnail' ) === 'false' ) : ?>

		<div class="entry">
			<?php Habakiri::the_title(); ?>
			<div class="entry__summary entry-summary">
				<?php the_excerpt(); ?>
			<!-- end .entry-summary --></div>
			<?php Habakiri::the_entry_meta(); ?>
		<!-- end .entry --></div>

	<?php else : ?>

		<div class="entry--has_media entry">
			<div class="entry--has_media__inner summary-with-thumbnail">
				<div class="entry--has_media__media summary-with-thumbnail-thumbnail">
					<?php Habakiri::the_post_thumbnail(); ?>
				<!-- end .media-left --></div>
				<div class="entry--has_media__body summary-with-thumbnail-body">
					<?php Habakiri::the_title(); ?>
					<div class="entry__summary entry-summary">
						<?php the_excerpt(); ?>
					<!-- end .entry-summary --></div>
					<?php Habakiri::the_entry_meta(); ?>
				<!-- end .media-body --></div>
			<!-- end .media --></div>
		<!-- end .entry --></div>

	<?php endif; ?>

</article>

<?php endif; ?>
