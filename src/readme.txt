=== Habakiri ===
Contributors: inc2734, shinichin
Donate link: http://www.amazon.co.jp/registry/wishlist/39ANKRNSTNW40
Tags: white, fixed-layout, fluid-layout, responsive-layout, one-column, two-columns, left-sidebar, right-sidebar, editor-style, sticky-post, microformats, featured-images, custom-colors, custom-menu, custom-background, custom-header, custom-colors
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 1.2.0
License: GPLv2 or later
License URI: license.txt

== Description ==
Habakiri is a simple theme based on Twitter Bootstrap. This theme's goal is to create a responsive, bootstrap based WordPress theme quickly. The design is kept simple to keep the simplicity of the Bootstrap. Features are, 100% responsive layouts, the Glyphicons and Genericons icons, 6 page templates, 6 header design patterns, many color settings, a lot of hooks, related posts, minified CSS and JavaScript, Gulp use, Sass and PHP Class in functions.php.

== Installation ==

= Installation using "Add New Theme" =
1. From your Admin UI (Dashboard), go to Appearance => Themes. Click the "Add New" button.
2. Search for theme, or click the "Upload" button, and then select the theme you want to install.
3. Click the "Install Now" button.

= Manual installation =
1. Upload the "habakiri" folder to the "/wp-content/themes/" directory.

= Activiation and Use =
1. Activate the Theme through the "Themes" menu in WordPress.

== Third-party resources ==

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

You can upload a logo image in Customizer.

= 6 page templates =

* Right Sidebar ( default )
* Left Sidebar
* No Sidebar
* Full Width ( Fixed )
* Full Width ( Fluid )
* For Front Page

= 5 blog layouts =

* Right Sidebar ( default )
* Left Sidebar
* No Sidebar
* Full Width ( Fixed )
* Full Width ( Fluid )

= Header paterns =

* Left logo + Right global navigation ( default )
* Top Left logo + Bottom Left global navigation
* Top Center logo + Bottom Center global navigation
* The fixed and non-fixed layout are provided for each layouts above.

= Widget areas =

* Sidebar
* Footer ( you can select number of columns )

= Navigation =

* Global navigation ( in header )
* Social navigation ( in footer )  
  If you enter URLs of social services, their icons will appear.

= HTML5, Microformats compatible =

HTML5 mark upped. Page structure follows Bootstrap and it's kept as simple as possible.

Micro formats compatible. WordPress, by default, outputs a class "hentry", which belongs to microformats and so this theme adjust everything with it.

= Front end page speed optimization =

Front end page optimization for speed is done by the theme. Compression/combining of CSS/Javascript files, and loading Javascripts on footer. Original files and SASS files are also bundled (but not loaded) in the theme, so you can use them on customizing.

= Useful CSS class =

* .section: A class for sectioning contents with margins in, for example, one page design.
* .section.section--image: A class to adjust background image for a section.
* .section.section--fixed: A fixed version of section.section--image class.
* .section .section--title: A class for section title.
* jumbotron .btn-default: A class which is provided in Bootstrap but I've customized it into Ghost style.

= Off campus navigation on mobiles =

Global menu goes off canvas on mobiles. You don't need to add another menu for mobile phones.

= Using child theme =

While you can @import or wp_enqueue_script the style.min.css from your child theme, I want to introduce you another way of creating a child theme, which you can utilize the variables and functions of Sassified Bootstrap. Set a Sass file in your child theme and @import /habakiri/src/scss/style so that you can compile them with Gulp and such.

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
				get_template_directory_uri() . '/style.min.css',
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

== Changelog ==

= 1.2.0 =
* Fixed offcanvas-nav bugs.
* Fixed mistake of license.
* Fixed comment form css bug.
* Fixed page header bug in 404 and search page.
* Changed global navigation pulldown menu background color.
* Changed CSS to BEM format.
* Update widgets styling.

= 1.1.7 =
* Fixed a bug that instagram icon isn't shown in social nav.
* Fixed a bread crumb bug in custom post type archive.
* Fixed incorrect microformats in archive page.
* Add search page template setting in customizer.
* Add 404 page template setting in customizer.

= 1.1.6 =
* Add entries-* classes.
* Changed article html structure.
* Fixed a related posts excerpt bug.
* Fixed typo.
* Bootstrap print css is disabled.

= 1.1.5 =
* Fixed a html invalid error.
* Change Theme URL.
* Add global navigation pulldown color setting in customizer.

= 1.1.4 =
* Fixed a bread crumb bug.
* Add filter hook habakiri_custom_background_defaults.
* Add filter hook habakiri_custom_header_defaults.
* Improvement of footer widget area UX.
* Update .section style.

= 1.1.3 =
* Fixed a comments area bug.
* Changed how to include content templates.
* Fixed a entry title bug in single page.
* Display the entry title in page when setting that does not display the page header.

= 1.1.2 =
* Fixed a Habakiri::the_title() bug.

= 1.1.1 =
* Update japanese translation.

= 1.1.0 =
* Fixed comments html bug.
* Add filter hook habakiri_copyright.
* Add filter hook habakiri_no_thumbnail_text.
* Add filter hook habakiri_post_thumbnail_link_classes.
* Add filter hook habakiri_post_thumbnail_size.
* Add action hook habakiri_prepend_entry_content_front_page_template.
* Add action hook habakiri_append_entry_content_front_page_template.
* Add action hook habakiri_before_title
* Add action hook habakiri_after_title
* Add page header displaying setting in customizer.
* Add logo text color setting in customizer.
* Add method Habakiri::the_title()
* Changed that posted comments to be displayed even if comment posting is not available.
* Some css fixes.

= 1.0.9 =
* Fixed a offcanvas menu bug in iOS7.1.

= 1.0.8 =
* Changed html structure.
* Fixed a related posts bug.
* Remove jquery.smoothScrolle.js
* Changed Sass structure.

= 1.0.7 =
* Update readme.txt.
* Compatibility with IE9 in wysiwyg editor.

= 1.0.6 =
* Fixed a gallery style bug.
* Fixed a related posts bug.

= 1.0.5 =
* Update navigation for smart phone.
* Fixed a bug of the background fixed.
* Compatibility with IE9

= 1.0.4 =
* Fixed enqueue style and script bugs.
* Fixed a comment reply link bug.
* Fixed a related posts bug.
* Fixed a bug that the side bar does not displayed.
* Changed font size of page header.
* Changed style for smartphone.

= 1.0.3 =
* Remove unnecessary css files.
* Optimization of css and js files load.

= 1.0.2 =
* Remove all files that are not necersarry for the productive version.
* Fix invalid HTML.
* Add uncompressed versions of JS files.

= 1.0.1 =
* Fixed a related posts bug.
* Fixed customizer bugs.
* Change license in package.json
* Update Tags.
* browserify is implemented.

= 1.0.0 =
* Initial Release
