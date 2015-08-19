<?php
/**
 * Version    : 1.1.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 19, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
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
	<?php
	/**
	 * backward compatible
	 * @since 1.2.0
	 */
	$header_classes = Habakiri::get_header_classses();

	$site_branding_size = Habakiri::get_site_branding_size();
	$gnav_size          = Habakiri::get_gnav_size();
	?>
	<header id="header" class="header <?php echo esc_attr( implode( ' ', $header_classes ) ); ?>">
		<?php do_action( 'habakiri_before_header_content' ); ?>
		<div class="container">
			<div class="row header__content header-content">
				<div class="col-xs-10 header__col header-content-col <?php echo esc_attr( $site_branding_size ); ?>">
					<div class="site-branding">
						<h1 class="site-branding__heading"><?php Habakiri::the_logo(); ?></h1>
					<!-- end .site-branding --></div>
				<!-- end .col-md-4 --></div>
				<div class="col-xs-2 header__col header-content-col <?php echo esc_attr( $gnav_size ); ?> global-nav-wrapper clearfix">
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
					<div id="responsive-btn"></div>
				<!-- end .col-md-8 --></div>
			<!-- end .row --></div>
		<!-- end .container --></div>
		<?php do_action( 'habakiri_after_header_content' ); ?>
	<!-- end #header --></header>
	<div id="contents" <?php ( is_singular() ) ? post_class() : print( 'class="hentry"' ); ?>>
		<?php do_action( 'habakiri_before_contents_content' ); ?>
