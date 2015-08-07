<?php
/**
 * Template Name: Full Width ( Fixed )
 *
 * Version      : 1.1.0
 * Author       : inc2734
 * Author URI   : http://2inc.org
 * Created      : April 17, 2015
 * Modified     : July 7, 2015
 * License      : GPLv2
 * License URI  : license.txt
 */
?>
<?php get_header(); ?>

<?php Habakiri::the_page_header(); ?>

<div class="container">
	<main id="main" role="main">
		<?php Habakiri::the_bread_crumb(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; ?>
	<!-- end #main --></main>
	
	<?php get_sidebar(); ?>
<!-- end .container --></div>

<?php get_footer(); ?>
