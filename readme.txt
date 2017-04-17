=== Habakiri ===
Contributors: inc2734, shinichin, ishidaweb, mignonstyle, tkc49, mekemoke
Donate link: http://www.amazon.co.jp/registry/wishlist/39ANKRNSTNW40
Tags: white, fixed-layout, fluid-layout, responsive-layout, one-column, two-columns, left-sidebar, right-sidebar, editor-style, sticky-post, microformats, featured-images, custom-colors, custom-menu, custom-background, custom-header, custom-colors
Requires at least: 4.1
Tested up to: 4.7.0
Stable tag: 2.5.2
License: GPLv2 or later
License URI: license.txt

== Description ==
Habakiri is the simple theme based on Bootstrap 3. This theme's goal is to create a responsive, bootstrap based WordPress theme quickly. The design is very simple, easy to create of child theme. Features are, 100% responsive layouts, the Glyphicons, Genericons, Font Awesome icons, 7 page templates, 8 header design patterns, many color settings, a lot of hooks, related posts, minified CSS and JavaScript, Sass and PHP Class in functions.php.

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

Font Awesome
Font License: SIL OFL 1.1
Code License: MIT License
Source      : https://fortawesome.github.io/Font-Awesome/

Unsplash
License: CC0
Source : https://download.unsplash.com/24/5895672523_2e8ce56485_o.jpg
Source : https://images.unsplash.com/photo-1427805371062-cacdd21273f1?fm=jpg
Source : https://images.unsplash.com/42/pygwO3glRbaBCh2uRyd4_8420_rgb.jpg

slick
License: MIT
Source : http://kenwheeler.github.io/slick/

== Theme features ==

= Logo setting =

You can upload a logo image in Customizer.

= 7 page templates =

* Right Sidebar ( default )
* Left Sidebar
* No Sidebar
* Full Width ( Fixed )
* Full Width ( Fluid )
* Blank Page
* Rich Front Page

= Slider =

You can use slider with BxSlider. The slider can be used in "Rich Front Page" template.

= 5 blog layouts =

* Right Sidebar ( default )
* Left Sidebar
* No Sidebar
* Full Width ( Fixed )
* Full Width ( Fluid )

= Header paterns =

* Left logo + Right global navigation ( default )
* Left logo + Right global navigation + Transparency
* Top Left logo + Bottom Left global navigation
* Top Center logo + Bottom Center global navigation
* The fixed and non-fixed layout are provided for each layouts above.

= Widget areas =

* Sidebar
* Footer ( You can select number of columns )

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
* .section .section__title: A class for section title.
* jumbotron .btn-default: A class which is provided in Bootstrap but I've customized it into Ghost style.

= Offcanvas navigation on mobiles =

Global menu goes offcanvas on mobiles. You don't need to add another menu for mobile phones.

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

= 2.5.2 =
* Fix global navigation layout bug on Safari.
* Fix bug that customizer default values are not refrected.

= 2.5.1 =
* Added Text Domain in style.css header.

= 2.5.0 =
* Update Font Awesome
* Update class.entry-meta.php
* Fix sanitize_textfield of customizer framework

= 2.4.0 =
* Added action hook habakiri_before_entries.
* Added action hook habakiri_after_entries.
* Added .pagination-wrapper for nav of pagination.
* Fixed page header php notice error.
* Remove .entry__content in archive page.
* Changed related posts conditions.

= 2.3.0 =
* IE9 support: Split the style.css.
* Changed related posts styles.
* Changed footer styles.
* Changed header z-index.
* Add font-awesome.
* If you use child theme, style.min.css of Habakiri is auto laoded.

= 2.2.1 =
* Habakiri_Related_Posts::get_related_posts() became a public method.
* Fixed a bug that wrapper is output even when there is no global navigation.

= 2.2.0 =
* Offcanvas navigation does not auto created when .off-canvas-nav exists.
* Refactoring global navigation styles.
* Refactoring getting slider image size.
* Fixed slider css bugs.
* Add filter hook habakiri_page_header_background_image.

= 2.1.0 =
* Fixed some css.
* Fixed a footer-widget-area bug when no footer widgets.
* Add action hook habakiri_before_site_branding.
* Add action hook habakiri_after_site_branding.
* Add template part site-branding.
* Add new setting: Offcanvas navigation slide direction.

= 2.0.1 =
* Fixed some css.

= 2.0.0 =
* Add slick and slider settings in customizer.
* Add rich front page template that is using slider.
* Add new setting: Header layout setting that is the transparent header.
* Add new setting: Breakpoint setting that to switch offcanvas navigation.
* Add new setting: Global navigation background color.
* Add new setting: Global navigation link background color.
* Add new setting: Global navigation link padding.
* Add new setting: Global navigation font size.
* Add new setting: Global navigation sub label.
* Add new setting: Hamburger button color.
* Add new setting: Excerpt length.
* Add filter hook habakiri_allow_hentry_post_types.
* Add filter hook habakiri_default_slider_items.
* Add .screen-reader-text class.
* Change $content_width.
* Change templates structure.
* Change class for executing Offcanvas nav that from .global-nav to .js-responsive-nav.
* Change page header size when custom header image is set.
* Change template name "For front page" to "Blank Page".
* Change not to display entry-title in front-page template.
* Change not to display the menu if the global navigation is not allocated.
* Change microformats support is single page only.
* Change name bread-crumb to breadcrumbs.
* Change archive page design.
* Improvement of footer widget area UX.
* Remove old classes ( not BEM format classes ).
* Style is generated from the Customizer is output after being compressed.
* Fixed a page header bug at custom post type.
* Deprecated function: Habakiri::the_bread_crumb()
* Deprecated function: Habakiri::the_copyright()
* Deprecated function: Habakiri::the_entry_meta()
* Deprecated function: Habakiri::the_logo()
* Deprecated function: Habakiri::the_page_header()
* Deprecated function: Habakiri::the_related_posts()
* Deprecated function: Habakiri::the_pager()
* Deprecated function: Habakiri::the_link_pages()

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
