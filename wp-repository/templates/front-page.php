<?php
/**
 * Template Name: Blank Page
 *
 * Version      : 1.3.0
 * Author       : inc2734
 * Author URI   : http://2inc.org
 * Created      : April 17, 2015
 * Modified     : August 30, 2015
 * License      : GPLv2 or later
 * License URI  : license.txt
 */
?>
<?php get_header(); ?>

<div class="container-fluid">
	<div class="row">
		<main id="main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( array( 'article', 'article--page' ) ); ?>>
				<div class="entry">
					<?php Habakiri::the_title(); ?>
					<?php do_action( 'habakiri_before_entry_content' ); ?>
					<div class="entry__content">
						<?php do_action( 'habakiri_prepend_entry_content_front_page_template' ); ?>
						<?php the_content(); ?>
						<?php do_action( 'habakiri_append_entry_content_front_page_template' ); ?>
					<!-- end .entry__content --></div>
					<?php do_action( 'habakiri_after_entry_content' ); ?>
				<!-- end .entry --></div>
			</article>
			<?php endwhile; ?>
			
		<!-- end #main --></main>
	<!-- end .row --></div>
<!-- end .container-fluid --></div>

<?php get_footer(); ?>
