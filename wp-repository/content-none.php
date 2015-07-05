<?php
/**
 * Version    : 1.1.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 5, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<article>

	<div class="entry-content">

		<?php if ( is_404() ) : ?>

			<p>
				<?php _e( 'Woops! Page not found.', 'habakiri' ); ?><br />
				<?php _e( 'The page you are looking for may be moved or deleted.', 'habakiri' ); ?><br />
				<?php _e ( 'Please search this serch box.', 'habakiri' ); ?>
			</p>
			<p>
				<?php get_search_form(); ?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'habakiri' ); ?>
			</p>
			<p>
				<?php get_search_form(); ?>
			</p>
			
		<?php else : ?>

			<p>
				<?php _e( 'No posts.', 'habakiri' ); ?>
			</p>
			
		<?php endif; ?>

	<!-- end .entry-content --></div>

</article>
