<?php
/**
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php get_header(); ?>

<?php Habakiri::the_page_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<main id="main" role="main">
				<?php get_template_part( 'content', 'none' ); ?>
			<!-- end #main --></main>
		<!-- end .col-md-9 --></div>
		<div class="col-md-3">
			<?php get_sidebar(); ?>
		<!-- end .col-md-3 --></div>
	<!-- end .row --></div>
<!-- end .container --></div>

<?php get_footer(); ?>
