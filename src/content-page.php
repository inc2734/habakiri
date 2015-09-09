<?php
/**
 * Version    : 1.3.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article <?php post_class( array( 'article', 'article--page' ) ); ?>>
	<div class="entry">
		<?php
		if ( Habakiri::get( 'is_displaying_page_header' ) === 'false' ) {
			Habakiri::the_title();
		}
		?>
		<?php do_action( 'habakiri_before_entry_content' ); ?>
		<div class="entry__content">
			<?php the_content(); ?>
		<!-- end .entry__content --></div>
		<?php do_action( 'habakiri_after_entry_content' ); ?>
	<!-- end .entry --></div>

	<?php get_template_part( 'modules/link-pages' ); ?>
	<?php
	if ( comments_open() || pings_open() || get_comments_number() ) {
		comments_template( '', true );
	}
	?>
</article>
