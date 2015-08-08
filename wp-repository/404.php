<?php
/**
 * Version    : 1.2.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 8, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php get_header(); ?>

<?php Habakiri::the_page_header(); ?>
<?php get_template_part( 'blog_templates/single/' . Habakiri::get( '404_template' ) ); ?>

<?php get_footer(); ?>
