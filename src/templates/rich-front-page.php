<?php
/**
 * Template Name: Rich Front Page
 *
 * Version      : 1.0.0
 * Author       : inc2734
 * Author URI   : http://2inc.org
 * Created      : August 15, 2015
 * Modified     :
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
				<?php get_template_part( 'modules/slider' ); ?>

				<div class="entry">
					<?php Habakiri::the_title(); ?>
					<?php do_action( 'habakiri_before_entry_content' ); ?>
					<div class="entry__content">
						<?php the_content(); ?>
					<!-- end .entry__content --></div>
					<?php do_action( 'habakiri_after_entry_content' ); ?>
				<!-- end .entry --></div>
			</article>
			<?php endwhile; ?>
			
		<!-- end #main --></main>
	<!-- end .row --></div>
<!-- end .container-fluid --></div>

<?php get_footer(); ?>
