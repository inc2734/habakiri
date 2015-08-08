<?php
/**
 * Version    : 1.2.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article class="article">
	<div class="entry">
		<?php
		if ( Habakiri::get( 'is_displaying_page_header' ) === 'false' ) {
			Habakiri::the_title();
		}
		?>
		<?php do_action( 'habakiri_before_entry_content' ); ?>
		<div class="entry__content entry-content">
			<?php the_content(); ?>
		<!-- end .entry-content --></div>
		<?php do_action( 'habakiri_after_entry_content' ); ?>
	<!-- end .entry --></div>
	
	<?php Habakiri::the_link_pages(); ?>
	<?php
	if ( comments_open() || pings_open() || get_comments_number() ) {
		comments_template( '', true );
	}
	?>
</article>