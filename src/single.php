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

<?php
$show_on_front  = get_option( 'show_on_front' );
$page_for_posts = get_option( 'page_for_posts' );
if ( $show_on_front === 'page' && $page_for_posts ) {
	Habakiri::the_page_header( $page_for_posts );
} else {
	printf( '<div class="no-page-header"></div>' );
}
?>

<?php get_template_part( 'blog_templates/single/' . Habakiri::get( 'blog_template' ) ); ?>

<?php get_footer(); ?>
