<?php
require_once get_template_directory() . '/inc/class.breadcrumbs.php';
require_once get_template_directory() . '/inc/class.entry-meta.php';
require_once get_template_directory() . '/inc/class.page-header.php';
require_once get_template_directory() . '/inc/class.related-posts.php';
require_once get_template_directory() . '/inc/class.slider.php';
require_once get_template_directory() . '/inc/class.habakiri-customizer-framework.php';
require_once get_template_directory() . '/inc/customizer.php';

function habakiri_parent_theme_setup() {
	if ( !class_exists( 'Habakiri' ) ) {
		class Habakiri extends Habakiri_Base_Functions {
			public function __construct() {
				parent::__construct();
			}
		}
	}
	$Habakiri = new Habakiri();
}
add_action( 'after_setup_theme', 'habakiri_parent_theme_setup', 99999 );

/**
 * Name       : Habakiri_Base_Functions
 * Version    : 1.4.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : October 24, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Base_Functions {

	/**
	 * __construct
	 */
	public function __construct() {
		global $content_width;
		if ( !isset( $content_width ) ) $content_width = 1140;
		load_theme_textdomain( 'habakiri', get_template_directory() . '/languages' );

		add_editor_style( array(
			'./editor-style.min.css',
		) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
		) );

		$custom_background_defaults = array();
		add_theme_support(
			'custom-background',
			apply_filters( 'habakiri_custom_background_defaults', $custom_background_defaults )
		);

		$custom_header_defaults = array(
			'width'          => 1366,
			'height'         => 768,
			'flex-height'    => false,
			'flex-width'     => false,
			'uploads'        => true,
			'random-default' => true,
			'header-text'    => false,
		);
		add_theme_support(
			'custom-header',
			apply_filters( 'habakiri_custom_header_defaults', $custom_header_defaults )
		);

		add_post_type_support( 'page', 'excerpt' );

		$this->customizer();
		$this->register_nav_menus();

		add_action( 'widgets_init'      , array( $this, 'register_sidebar' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_head'           , array( $this, 'styles_bugfix_for_safari' ) );
		add_action( 'wp_footer'         , array( $this, 'wp_footer' ) );

		add_filter( 'query_vars'                 , array( $this, 'query_vars' ) );
		add_filter( 'tiny_mce_before_init'       , array( $this, 'tiny_mce_before_init' ) );
		add_filter( 'body_class'                 , array( $this, 'body_class' ) );
		add_filter( 'post_class'                 , array( $this, 'post_class' ) );
		add_filter( 'walker_nav_menu_start_el'   , array( $this, 'walker_nav_menu_start_el' ), 10, 4 );
		add_filter( 'excerpt_length'             , array( $this, 'excerpt_length' ), 9 );
		add_filter( 'excerpt_mblength'           , array( $this, 'excerpt_length' ), 9 );

		add_filter( 'comment_form_default_fields', array( $this, 'comment_form_default_fields' ) );
		add_filter( 'comment_form_field_comment' , array( $this, 'comment_form_field_comment' ) );
		add_filter( 'comment_form_submit_field'  , array( $this, 'comment_form_submit_field' ) );

		add_filter( 'get_calendar'               , array( $this, 'get_calendar' ) );
	}

	/**
	 * Add query var for related posts
	 *
	 * @param array $public_query_vars
	 * @return array
	 */
	public function query_vars( $public_query_vars ) {
		$public_query_vars[] = 'is_related';
		return $public_query_vars;
	}

	/**
	 * Add the class to tne wysiwyg editor
	 *
	 * @param array $init
	 * @return array
	 */
	public function tiny_mce_before_init( $init ){
		$init['body_class'] = 'entry__content';
		return $init;
	}

	/**
	 * Theme customizer
	 */
	protected function customizer() {
		$Customizer = new Habakiri_Customizer();
		add_action( 'wp_head', array( $Customizer, 'register_styles' ) );
		add_action( 'customize_register', array( $Customizer, 'customize_register' ) );
	}

	/**
	 * Register menus
	 */
	protected function register_nav_menus() {
		add_theme_support( 'menu' );
		register_nav_menus( array(
			'global-nav' => __( 'Global Navigation', 'habakiri' ),
			'social-nav' => __( 'Social Navigation', 'habakiri' ),
		) );
	}

	/**
	 * Return the classes for header
	 *
	 * @return array
	 */
	public static function get_header_classses() {
		$header_classes[] = Habakiri::get( 'header' );
		$header_classes[] = Habakiri::get( 'header_fixed' );
		return $header_classes;
	}

	/**
	 * Register widget areas
	 */
	public function register_sidebar() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'habakiri' ),
			'id'            => 'sidebar',
			'description'   => __( 'Sidebar', 'habakiri' ),
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="sidebar-widget__title h4">',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer', 'habakiri' ),
			'id'            => 'footer-widget-area',
			'description'   => __( 'Footer Widget Area', 'habakiri' ),
			'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-widget__title">',
		) );

		add_filter(
			'dynamic_sidebar_params',
			array( $this, 'dynamic_sidebar_params' )
		);
	}

	/**
	 * Return the class of culumn size for footer widget area
	 *
	 * @param array $params ウィジェットエリア設定の配列
	 * @return array
	 */
	public function dynamic_sidebar_params( $params ) {
		if ( isset( $params[0]['id'] ) && $params[0]['id'] === 'footer-widget-area' ) {
			$class = Habakiri::get( 'footer_columns' );
			$params[0]['before_widget'] = str_replace(
				'class="widget',
				'class="' . Habakiri::get( 'footer_columns' ) . ' widget',
				$params[0]['before_widget']
			);
		}
		return $params;
	}

	/**
	 * Display comments
	 *
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 */
	public static function the_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class( array( 'comments__item' ) ); ?> id="li-comment-<?php comment_ID() ?>">
			<dl id="comment-<?php comment_ID(); ?>" class="comment">
				<dt class="comment__header">
					<div class="comment__author">
						<?php echo get_avatar( $comment, '48' ); ?>
					<!-- end .comment-author --></div>
				</dt>
				<dd class="comment__body">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'habakiri' ) ?></em>
					<?php endif; ?>
					<div class="comment__meta vcard">
						<?php
						printf(
							__( '<cite class="fn">%1$s</cite> said on %2$s at %3$s', 'habakiri' ),
							get_comment_author_link(),
							get_comment_date(),
							get_comment_time()
						);
						edit_comment_link( 'edit', '  ', '' );
						?>
					<!-- end .comment-meta --></div>
					<?php comment_text() ?>
					<?php
					$comment_reply_link = get_comment_reply_link(
						array_merge(
							$args,
							array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							)
						)
					);
					?>
					<?php if ( !empty( $comment_reply_link ) ) : ?>
					<div class="comment__reply reply btn btn-sm btn-primary">
						<?php echo $comment_reply_link; ?>
					<!-- end .reply --></div>
					<?php endif; ?>
				</dd>
			</dl>
		<?php
	}

	/**
	 * Display trackbacks
	 *
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 */
	public static function the_pings( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class( array( 'trackbacks__item' ) ); ?> id="li-comment-<?php comment_ID() ?>">
			<dl id="comment-<?php comment_ID(); ?>" class="trackback">
				<dd class="trackback__body">
					<div class="trackback__meta vcard">
						<?php
						printf(
							__( '<cite class="fn">%1$s</cite> said on %2$s at %3$s', 'habakiri' ),
							get_comment_author_link(),
							get_comment_date(),
							get_comment_time()
						);
						edit_comment_link( 'edit', '  ', '' );
						?>
					<!-- end .comment-meta --></div>
					<?php comment_text() ?>
				</dd>
			</dl>
		<?php
	}

	/**
	 * Load the CSS and JS
	 */
	public function wp_enqueue_scripts() {
		$url     = get_template_directory_uri();
		$theme   = wp_get_theme();
		$version = $theme->get( 'Version' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$assets_name = get_template() . '-assets';
		wp_enqueue_style(
			$assets_name,
			$url . '/css/assets.min.css',
			array(),
			$version
		);

		wp_enqueue_style(
			get_template(),
			$url . '/style.min.css',
			array( $assets_name ),
			date( 'YmdHis', filemtime( get_stylesheet_directory() . '/style.css' ) )
		);

		if ( is_child_theme() ) {
			wp_enqueue_style(
				get_stylesheet(),
				get_stylesheet_uri(),
				array( $assets_name ),
				date( 'YmdHis', filemtime( get_stylesheet_directory() . '/style.css' ) )
			);
		}

		wp_enqueue_script(
			get_template(),
			$url . '/js/app.min.js',
			array( 'jquery' ),
			$version,
			true
		);
	}

	/**
	 * Safari 6.1+ (10.0 is the latest version of Safari at this time)
	 * @see https://github.com/inc2734/habakiri/issues/17
	 */
	public function styles_bugfix_for_safari() {
		?>
		<style>
		/* Safari 6.1+ (10.0 is the latest version of Safari at this time) */
		@media (max-width: 991px) and (min-color-index: 0) and (-webkit-min-device-pixel-ratio: 0) { @media () {
			display: block !important;
			.header__col {
				width: 100%;
			}
		}}
		</style>
		<?php
	}

	public function wp_footer() {
		?>
		<script>
		jQuery( function( $ ) {
			$( '.js-responsive-nav' ).responsive_nav( {
				direction: '<?php echo esc_js( Habakiri::get( 'offcanvas_nav_direction' ) ); ?>'
			} );
		} );
		</script>
		<?php
	}

	/**
	 * Return body classes
	 * Add the appropriate class by the layout of the blog
	 */
	public function body_class( $classes ) {
		global $template;
		$template_file = basename( $template );

		if ( in_array( $template_file, array( 'single.php', 'archive.php' ) ) ) {
			if ( is_single() ) {
				$classes[] = 'blog-template-single-' . Habakiri::get( 'blog_template');
			} elseif ( !is_singular() ) {
				$classes[] = 'blog-template-archive-' . Habakiri::get( 'blog_template');
			}
		}
		return $classes;
	}

	/**
	 * Output hentry class  when the single page only
	 *
	 * @param array $classes
	 * @return array
	 */
	public function post_class( $classes ) {
		$allow_hentry_post_types = apply_filters( 'habakiri_allow_hentry_post_types', array( 'post' ) );
		if ( !in_array( get_post_type(), $allow_hentry_post_types ) ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
		return $classes;
	}

	/**
	 * Display description in global navigation
	 *
	 * @param string $output HTML
	 * @param object $item
	 * @param int $depth
	 * @param object $args
	 * @return string
	 */
	public function walker_nav_menu_start_el( $output, $item, $depth, $args ) {
		if ( $depth === 0 && $args->theme_location === 'global-nav' && !empty( $item->description ) ) {
			$pattern     = '/(<a.*?>)([^<]*?)(<\/a>)/';
			$replacement = '$1<strong>$2</strong><small>' . esc_html( $item->description ) . '</small>$3';
			return preg_replace( $pattern, $replacement, $output );
		}
		return $output;
	}

	/**
	 * Excerpt length
	 *
	 * @param int
	 * @return int
	 */
	public function excerpt_length( $length ) {
		return Habakiri::get( 'excerpt_length' );
	}

	/**
	 * Comment form text field styling
	 *
	 * @param array $fields
	 * @return array
	 */
	public function comment_form_default_fields( $fields ) {
		foreach ( $fields as $key => $field ) {
			$fields[$key] = preg_replace( '/(id=".+?")/', '$1 class="form-control"', $field );
		}
		return $fields;
	}

	/**
	 * Comment form textarea styling
	 *
	 * @param string $comment_field
	 * @return string
	 */
	public function comment_form_field_comment( $comment_field ) {
		$comment_field = preg_replace( '/(id=".+?")/', '$1 class="form-control"', $comment_field );
		return $comment_field;
	}

	/**
	 * Comment form button styling
	 *
	 * @param string $comment_field
	 * @return string
	 */
	public function comment_form_submit_field( $submit_field ) {
		$submit_field = str_replace( 'class="submit"', 'class="submit btn btn-primary"', $submit_field );
		return $submit_field;
	}

	/**
	 * Calendar styling
	 *
	 * @param string $calendar
	 * @return string
	 */
	public function get_calendar( $calendar ) {
		return str_replace( '<table', '<table class="table"', $calendar );
	}

	/**
	 * Return the theme option
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get( $key ) {
		$default   = Habakiri_Customizer::get_default( $key );
		$theme_mod = get_theme_mod( $key, $default );
		return $theme_mod;
	}

	/**
	 * Header whether a line
	 *
	 * @return bool
	 */
	public static function is_one_row_header() {
		$headers = array( 'header--default', 'header--transparency' );
		if ( in_array( Habakiri::get( 'header' ), $headers ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Display the copyright
	 */
	public static function the_copyright() {
		_deprecated_function( 'Habakiri::the_copyright()', 'Habakiri 2.0.0', "get_template_part( 'modules/copyright' )" );
		get_template_part( 'modules/copyright' );
	}

	/**
	 * Display the logo
	 */
	public static function the_logo() {
		_deprecated_function( 'Habakiri::the_logo()', 'Habakiri 2.0.0', "get_template_part( 'modules/logo' )" );
		get_template_part( 'modules/logo' );
	}

	/**
	 * Display the page header
	 *
	 * @param int $post_id
	 */
	public static function the_page_header( $post_id = null ) {
		_deprecated_function( 'Habakiri::the_page_header()', 'Habakiri 2.0.0', "get_template_part( 'modules/page-header' )" );
		get_template_part( 'modules/page-header' );
	}

	/**
	 * Display the breadcrumbs
	 */
	public static function the_bread_crumb() {
		_deprecated_function( 'Habakiri::the_bread_crumb()', 'Habakiri 2.0.0', "get_template_part( 'modules/breadcrumbs' )" );
		get_template_part( 'modules/breadcrumbs' );
	}

	/**
	 * Display the post thumbnail
	 */
	public static function the_post_thumbnail() {
		$classes = array(
			'entry--has_media__link',
		);
		if ( !has_post_thumbnail() ) {
			$classes[] = 'entry--has_media__link--text';
		}
		$classes = apply_filters( 'habakiri_post_thumbnail_link_classes', $classes );
		?>
		<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php
				$size = apply_filters( 'habakiri_post_thumbnail_size', 'thumbnail' );
				the_post_thumbnail( $size, array(
					'class' => '',
				) );
				?>
			<?php else : ?>
				<span class="entry--has_media__text">
					<?php echo apply_filters( 'habakiri_no_thumbnail_text', get_the_time( 'd' ) ); ?>
				</span>
			<?php endif; ?>
		</a>
		<?php
	}

	/**
	 * Display the related posts
	 */
	public static function the_related_posts() {
		_deprecated_function( 'Habakiri::the_related_posts()', 'Habakiri 2.0.0', "get_template_part( 'modules/related-posts' )" );
		get_template_part( 'modules/related-posts' );
	}

	/**
	 * Return the custom taxonomies of the current post
	 *
	 * @param int|null $post_id
	 * @return array
	 */
	public static function get_the_taxonomies( $post_id = null ) {
		$post_type_object = get_post_type_object( get_post_type( $post_id ) );
		if ( !empty( $post_type_object->taxonomies ) ) {
			return $post_type_object->taxonomies;
		}
		return array();
	}

	/**
	 * Display the posts pagination
	 */
	public static function the_pager() {
		_deprecated_function( 'Habakiri::the_pager()', 'Habakiri 2.0.0', "get_template_part( 'modules/pagination' )" );
		get_template_part( 'modules/pagination' );
	}

	/**
	 * Display the entry meta
	 */
	public static function the_entry_meta() {
		_deprecated_function( 'Habakiri::the_entry_meta()', 'Habakiri 2.0.0', "get_template_part( 'modules/entry-meta' )" );
		get_template_part( 'modules/entry-meta' );
	}

	/**
	 * Display the link pages
	 */
	public static function the_link_pages() {
		_deprecated_function( 'Habakiri::the_link_pages()', 'Habakiri 2.0.0', "get_template_part( 'modules/link-pages' )" );
		get_template_part( 'modules/link-pages' );
	}

	/**
	 * Display the title
	 *
	 * @param int|null $post_id
	 */
	public static function the_title( $post_id = null ) {
		global $wp_query;
		$post    = get_post( $post_id );
		$post_id = isset( $post->ID ) ? $post->ID : 0;
		if ( !$post_id ) {
			return;
		}
		do_action( 'habakiri_before_title' );
		?>
		<?php if ( get_query_var( 'is_related' ) ) : ?>
		<h1 class="entry__title entry-title h4"><a href="<?php the_permalink(); ?>"><?php echo get_the_title( $post_id ); ?></a></h1>
		<?php elseif ( is_page() ) : ?>
			<?php if ( !is_page_template( 'templates/front-page.php' ) && !is_page_template( 'templates/rich-front-page.php' ) ) : ?>
			<h1 class="entry__title"><?php echo get_the_title( $post_id ); ?></h1>
			<?php endif; ?>
		<?php elseif ( is_single() ) : ?>
		<h1 class="entry__title entry-title"><?php echo get_the_title( $post_id ); ?></h1>
		<?php else : ?>
		<h1 class="entry__title entry-title h3"><a href="<?php the_permalink(); ?>"><?php echo get_the_title( $post_id ); ?></a></h1>
		<?php endif; ?>
		<?php
		do_action( 'habakiri_after_title' );
	}

	/**
	 * Return size of the site branding
	 *
	 * @return string
	 */
	public static function get_site_branding_size() {
		$gnav_breakpoint = Habakiri::get( 'gnav_breakpoint' );
		if ( !$gnav_breakpoint ) {
			return;
		}
		if ( Habakiri::is_one_row_header() ) {
			return sprintf( 'col-%s-4', $gnav_breakpoint );
		}
		return sprintf( 'col-%s-12', $gnav_breakpoint );
	}

	/**
	 * Return size of the global navigation wrapper
	 *
	 * @return string
	 */
	public static function get_gnav_size() {
		$gnav_breakpoint = Habakiri::get( 'gnav_breakpoint' );
		if ( !$gnav_breakpoint ) {
			return;
		}
		if ( Habakiri::is_one_row_header() ) {
			return 'col-' . $gnav_breakpoint . '-8';
		}
		return 'col-' . $gnav_breakpoint . '-12';
	}

	/**
	 * Return the breakpoint when switching responsive_nav <> offcanvas_nav
	 *
	 * @return int
	 */
	public static function get_gnav_breakpoint() {
		$breakpoint      = null;
		$gnav_breakpoint = Habakiri::get( 'gnav_breakpoint' );
		switch ( $gnav_breakpoint ) {
			case 'md' :
				$breakpoint = 992;
				break;
			case 'lg' :
				$breakpoint = 1200;
				break;
		}
		return $breakpoint;
	}
}
