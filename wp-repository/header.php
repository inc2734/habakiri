<?php
/**
 * Version    : 1.0.2
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 12, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# <?php echo ( is_single() || is_page() ) ? 'fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#' : 'fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#' ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'habakiri_before_container' ); ?>
<div id="container">
	<header id="header" class="<?php echo esc_attr( Habakiri::get( 'header' ) ) ?> <?php echo esc_attr( Habakiri::get( 'header_fixed' ) ) ?>">
		<?php do_action( 'habakiri_before_header_content' ); ?>
		<div class="container">
			<div class="row header-content">
				<div class="col-xs-10 header-content-col <?php echo ( Habakiri::is_one_row_header() ) ? 'col-md-4' : 'col-md-12'; ?>">
					<div class="site-branding">
						<h1><?php Habakiri::the_logo(); ?></h1>
					<!-- end .site-branding --></div>
				<!-- end .col-md-4 --></div>
				<div class="col-xs-2 header-content-col <?php echo ( Habakiri::is_one_row_header() ) ? 'col-md-8' : 'col-md-12'; ?> global-nav-wrapper clearfix">
					<?php do_action( 'habakiri_before_global_navigation' ); ?>
					<nav class="global-nav" role="navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'global-nav',
							'depth'          => 0,
						) );
						?>
					<!-- end .global-nav --></nav>
					<?php do_action( 'habakiri_after_global_navigation' ); ?>
					<div id="responsive-btn" class="hidden-md hidden-lg"></div>
				<!-- end .col-md-8 --></div>
			<!-- end .row --></div>
		<!-- end .container --></div>
		<?php do_action( 'habakiri_after_header_content' ); ?>
	<!-- end #header --></header>
	<div id="contents" <?php if ( is_singular() ) post_class(); ?>>
		<?php do_action( 'habakiri_before_contents_content' ); ?>
