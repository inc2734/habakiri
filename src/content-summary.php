<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 28, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<article <?php post_class( array( 'article', 'article--summary' ) ); ?>>

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
