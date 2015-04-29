=== Habakiri ===
Contributors: inc2734
Donate link: http://www.amazon.co.jp/registry/wishlist/39ANKRNSTNW40
Tags: white, fixed-layout, fluid-layout, responsive-layout, one-column, two-columns, left-sidebar, right-sidebar, editor-style, sticky-post, microformats, featured-images, custom-colors, custom-menu, custom-background, custom-header, custom-colors
Requires at least: 4.1
Tested up to: 4.2.1
Stable tag: 1.0.1
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Habakiri is a simple theme for the web site. This theme based on Twitter Bootstrap. Features, 100% responsive layouts, the Glyphicons and Genericons icons, 6 page templates, 6 header design patterns, many color settings, many hooks, displaying related posts in single page, using minify CSS and JavaScript, using Gulp, Sass and PHP Class in functions.php.

== Installation ==

= Installation using "Add New Theme" =
1. From your Admin UI (Dashboard), go to Appearance => Themes. Click the "Add New" button.
2. Search for theme, or click the "Upload" button, and then select the theme you want to install.
3. Click the "Install Now" button.

= Manual installation =
1. Upload the "habakiri" folder to the "/wp-content/themes/" directory.

= Activiation and Use =
1. Activate the Theme through the "Themes" menu in WordPress.

== The following third-party resources ==

Bootstrap
License: MIT
Source : http://getbootstrap.com/

HTML5 Shiv
License: MIT/GPL2 License
Source : https://github.com/aFarkas/html5shiv

Genericons
License: GPL
Source : http://genericons.com/

Unsplash - Photo for screenshot.png
License: CC0
Source : https://download.unsplash.com/24/5895672523_2e8ce56485_o.jpg

== Theme features ==

= Logo setting =

You can upload and setting logo image in Customizer.

= 6 page templates =

* Right Sidebar ( default )
* Left Sidebar
* No Sodebar
* Full Width ( Fixed )
* Full Width ( Fluid )
* For Front Page

= 5 blog layouts =

* Right Sidebar ( default )
* Left Sidebar
* No Sodebar
* Full Width ( Fixed )
* Full Width ( Fluid )

= Header paterns =

* Left logo + Right global navigation ( default )
* Top Left logo + Bottom Left global navigation
* Top Center logo + Bottom Center global navigation
* The fixed and non-fixed to each.

= Widget areas =

* Sidebar
* Footer ( you can select number of columns )

= Navigation =

* Global navigation ( in header )
* Social navigation ( in footer )  
  If you enter the URL of the social service, icon appears.

= Useful CSS class =

* .section
* .section.section-image
* .section.section-fixed
* .section .section-title

= Using child theme =

This is a example of customizing functions.php in child theme.

`
// in functions.php
function habakiri_child_theme_setup() {
	class Habakiri extends Habakiri_Base_Functions {
		// Override constructer
		public function __construct() {
			parent::__construct();
			// Add filter
			add_filter( 'foo', array( $this, 'your_filter' ) );
		}

		// load style.css of habakiri
		// If you use bottstrap of habakiri, this method is unnecessary.
		public function wp_enqueue_scripts() {
			wp_enqueue_style(
				get_template(),
				get_template_directory_uri() . '/style.css',
				null
			);
			parent::wp_enqueue_scripts();
		}

		public function your_filter( $bar ) {
			return $bar;
		}

		// Override parent method
		public function parent_method() {
			// Your code!
		}
	}
}
add_action( 'after_setup_theme', 'habakiri_child_theme_setup' );

// It is all right outside the class!
function your_filter( $bar ) {
	return $bar;
}
add_filter( 'foo', 'your_filter' );
`

= Using bottstrap of habakiri =

1. Copy themes/habakiri/package.json, gulpfile.js to themes/your_theme
2. Move themes/your_theme and "npm install" in Terminal.
3. Create themes/your_theme/scr/scss/style.scss
`
/*!
Theme Name: your_theme
Template: habakiri
*/

@import '../../../habakiri/src/scss/bootstrap-variables';
@import '../../../habakiri/assets/bootstrap/stylesheets/bootstrap';
@import '../../../habakiri/assets/genericons/genericons.css';
@import '../../../habakiri/src/scss/layout';
@import '../../../habakiri/src/scss/bootstrap-overwrite';
@import '../../../habakiri/src/scss/content';
`
4. "gulp watch" in Terminal and edit style.scss.

== Changelog ==

= 1.0.1 =
* Fixed a related posts bug.
* Fixed customizer bugs.
* Change license in package.json

= 1.0.0 =
* Initial Release
