<?php
/**
 * Template Name: For Front Page
 *
 * Version      : 1.1.0
 * Author       : Takashi Kitajima
 * Author URI   : http://2inc.org
 * Created      : April 17, 2015
 * Modified     : July 1, 2015
 * License      : GPLv2
 * License URI  : http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php get_header(); ?>

<div class="container-fluid">
	<div class="row">
		<main id="main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<?php do_action( 'habakiri_before_entry_content' ); ?>
				<?php Habakiri::the_title(); ?>
				<div class="entry-content">
					<?php do_action( 'habakiri_prepend_entry_content_front_page_template' ); ?>
					<?php the_content(); ?>
					<?php do_action( 'habakiri_append_entry_content_front_page_template' ); ?>
				<!-- end .entry-content --></div>
				<?php do_action( 'habakiri_after_entry_content' ); ?>
			</article>
			<?php endwhile; ?>
		<!-- end #main --></main>
	<!-- end .row --></div>
<!-- end .container-fluid --></div>

<?php get_footer(); ?>
