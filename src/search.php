<?php
/**
 * Version    : 1.2.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 31, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'blog_templates/archive/' . Habakiri::get( 'search_template' ) ); ?>

<?php get_footer(); ?>
