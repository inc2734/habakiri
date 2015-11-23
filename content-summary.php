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
			<div class="entry__summary">
				<?php the_excerpt(); ?>
			<!-- end .entry__summary --></div>
			<?php get_template_part( 'modules/entry-meta' ); ?>
		<!-- end .entry --></div>

	<?php else : ?>

		<div class="entry--has_media entry">
			<div class="entry--has_media__inner">
				<div class="entry--has_media__media">
					<?php Habakiri::the_post_thumbnail(); ?>
				<!-- end .entry--has_media__media --></div>
				<div class="entry--has_media__body">
					<?php Habakiri::the_title(); ?>
					<div class="entry__summary">
						<?php the_excerpt(); ?>
					<!-- end .entry__summary --></div>
					<?php get_template_part( 'modules/entry-meta' ); ?>
				<!-- end .entry--has_media__body --></div>
			<!-- end .entry--has_media__inner --></div>
		<!-- end .entry--has_media --></div>

	<?php endif; ?>

</article>
