<?php
/**
 * Template Name: No Sidebar
 *
 * Version      : 1.1.0
 * Author       : inc2734
 * Author URI   : http://2inc.org
 * Created      : April 17, 2015
 * Modified     : July 5, 2015
 * License      : GPLv2
 * License URI  : license.txt
 */
?>
<?php get_header(); ?>

<?php Habakiri::the_page_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<main id="main" role="main">
				<?php Habakiri::the_bread_crumb(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; ?>
			<!-- end #main --></main>
		<!-- end .col-md-10 --></div>
	<!-- end .row --></div>
<!-- end .container --></div>

<?php get_footer(); ?>
