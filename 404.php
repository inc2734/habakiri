<?php
/**
 * Version    : 1.3.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 30, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'modules/page-header' ); ?>
<div class="sub-page-contents">
	<?php get_template_part( 'blog_templates/single/' . Habakiri::get( '404_template' ) ); ?>
<!-- end .sub-page-contents --></div>

<?php get_footer(); ?>
