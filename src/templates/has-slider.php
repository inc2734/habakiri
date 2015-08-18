<?php
/**
 * Template Name: Has Slider
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
			<article class="article">
				<?php Habakiri::the_slider(); ?>

				<div class="entry">
					<?php Habakiri::the_title(); ?>
					<?php do_action( 'habakiri_before_entry_content' ); ?>
					<div class="entry__content entry-content">
						<?php the_content(); ?>
					<!-- end .entry-content --></div>
					<?php do_action( 'habakiri_after_entry_content' ); ?>
				<!-- end .entry --></div>
			</article>
			<?php endwhile; ?>
		<!-- end #main --></main>
	<!-- end .row --></div>
<!-- end .container-fluid --></div>

<?php get_footer(); ?>
