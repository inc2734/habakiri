<?php
/**
 * Template Name: Full Width ( Fluid )
 *
 * Version      : 1.0.0
 * Author       : Takashi Kitajima
 * Author URI   : http://2inc.org
 * Created      : April 17, 2015
 * Modified     : 
 * License      : GPLv2
 * License URI  : http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php get_header(); ?>

<?php Habakiri::the_page_header(); ?>

<div class="container-fluid">
	<main id="main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; ?>
	<!-- end #main --></main>
<!-- end .container-fluid --></div>

<?php get_footer(); ?>
