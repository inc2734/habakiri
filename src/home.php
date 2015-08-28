<?php
/**
 * Version    : 1.0.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<?php get_header(); ?>

<?php
$custom_post_types = get_post_types( array(
	'_builtin' => false,
) );
if ( in_array( get_post_type(), $custom_post_types ) ) {
	Habakiri::the_page_header();
} else {
	$show_on_front  = get_option( 'show_on_front' );
	$page_for_posts = get_option( 'page_for_posts' );
	if ( $show_on_front === 'page' && $page_for_posts ) {
		Habakiri::the_page_header( $page_for_posts );
	} else {
		printf( '<div class="no-page-header"></div>' );
	}
}
?>

<?php get_template_part( 'blog_templates/archive/' . Habakiri::get( 'blog_template' ) ); ?>

<?php get_footer(); ?>
