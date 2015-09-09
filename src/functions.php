<?php
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
 * Version    : 1.3.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 30, 2015
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
			'./assets/genericons/genericons.css',
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

		add_filter( 'tiny_mce_before_init'    , array( $this, 'tiny_mce_before_init' ) );
		add_filter( 'body_class'              , array( $this, 'body_class' ) );
		add_filter( 'post_class'              , array( $this, 'post_class' ) );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'walker_nav_menu_start_el' ), 10, 4 );
	}

	/**
	 * 管理画面の wysiwyg エディタに class を追加
	 *
	 * @param array $init
	 * @return array
	 */
	function tiny_mce_before_init( $init ){
		$init['body_class'] = 'entry__content';
		return $init;
	}

	/**
	 * カスタマイザーに設定を追加
	 */
	protected function customizer() {
		$Customizer = new Habakiri_Customizer();
		add_action( 'wp_head', array( $Customizer, 'register_styles' ) );
		add_action( 'customize_register', array( $Customizer, 'customize_register' ) );
	}

	/**
	 * メニューを追加
	 */
	protected function register_nav_menus() {
		add_theme_support( 'menu' );
		register_nav_menus( array(
			'global-nav' => __( 'Global Navigation', 'habakiri' ),
			'social-nav' => __( 'Social Navigation', 'habakiri' ),
		) );
	}

	/**
	 * ヘッダー用のクラスを出力
	 *
	 * @return array
	 */
	public static function get_header_classses() {
		$header_classes[] = Habakiri::get( 'header' );
		$header_classes[] = Habakiri::get( 'header_fixed' );
		return $header_classes;
	}

	/**
	 * ウィジェットエリアを追加
	 */
	public function register_sidebar() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'habakiri' ),
			'id'            => 'sidebar',
			'description'   => __( 'Sidebar', 'habakiri' ),
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="sidebar-widget__title">',
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
	 * フッターウィジェットの class を追加
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
	 * コメントを表示
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
	 * トラックバックを表示
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
	 * CSS、JS の読み込み
	 */
	public function wp_enqueue_scripts() {
		if ( is_admin() ) {
			return;
		}

		$url     = get_template_directory_uri();
		$theme   = wp_get_theme();
		$version = $theme->get( 'Version' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_child_theme() ) {
			$stylesheet = get_stylesheet_uri();
		} else {
			$stylesheet = $url . '/style.min.css';
		}
		wp_enqueue_style(
			get_stylesheet(),
			$stylesheet,
			$version
		);

		wp_enqueue_style(
			'genericons',
			$url . '/assets/genericons/genericons.css',
			$version
		);

		wp_enqueue_script(
			get_template(),
			$url . '/js/app.min.js',
			array( 'jquery' ),
			$version,
			true
		);
	}

	/**
	 * body の class を設定
	 * ブログのレイアウトによって適切なクラスを追加
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
	 * single のときのみ hentry を出力
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
	
	public function walker_nav_menu_start_el( $output, $item, $depth, $args ) {
		if ( $depth === 0 && !empty( $item->description ) ) {
			$pattern     = '/(<a.*?>)([^<]*?)(<\/a>)/';
			$replacement = '$1<strong>$2</strong><small>' . esc_html( $item->description ) . '</small>$3';
			return preg_replace( $pattern, $replacement, $output );
		}
		return $output;
	}

	/**
	 * テーマオプションを取得
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
	 * ヘッダーが1行かどうか
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
	 * copyright を表示
	 */
	public static function the_copyright() {
		_deprecated_function( 'Habakiri::the_copyright()', 'Habakiri 2.0.0', "get_template_part( 'modules/copyright' )" );
		get_template_part( 'modules/copyright' );
	}

	/**
	 * ロゴを表示
	 */
	public static function the_logo() {
		_deprecated_function( 'Habakiri::the_logo()', 'Habakiri 2.0.0', "get_template_part( 'modules/logo' )" );
		get_template_part( 'modules/logo' );
	}

	/**
	 * ページヘッダーを表示
	 *
	 * @param int $post_id
	 */
	public static function the_page_header( $post_id = null ) {
		_deprecated_function( 'Habakiri::the_page_header()', 'Habakiri 2.0.0', "get_template_part( 'modules/page-header' )" );
		get_template_part( 'modules/page-header' );
	}

	/**
	 * パンくずリストを表示
	 */
	public static function the_bread_crumb() {
		_deprecated_function( 'Habakiri::the_bread_crumb()', 'Habakiri 2.0.0', "get_template_part( 'modules/bread-crumb' )" );
		get_template_part( 'modules/bread-crumb' );
	}

	/**
	 * サムネイルを表示
	 */
	public static function the_post_thumbnail() {
		$classes = array(
			'img-circle',
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
	 * 関連記事を表示
	 */
	public static function the_related_posts() {
		_deprecated_function( 'Habakiri::the_related_posts()', 'Habakiri 2.0.0', "get_template_part( 'modules/related-posts' )" );
		get_template_part( 'modules/related-posts' );
	}

	/**
	 * 現在の投稿のカスタムタクソノミーを取得
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
	 * ページャーを表示
	 */
	public static function the_pager() {
		_deprecated_function( 'Habakiri::the_pager()', 'Habakiri 2.0.0', "get_template_part( 'modules/pagination' )" );
		get_template_part( 'modules/pagination' );
	}

	/**
	 * エントリーメタを表示
	 */
	public static function the_entry_meta() {
		_deprecated_function( 'Habakiri::the_entry_meta()', 'Habakiri 2.0.0', "get_template_part( 'modules/entry-meta' )" );
		get_template_part( 'modules/entry-meta' );
	}

	/**
	 * ページ分割
	 */
	public static function the_link_pages() {
		_deprecated_function( 'Habakiri::the_link_pages()', 'Habakiri 2.0.0', "get_template_part( 'modules/link-pages' )" );
		get_template_part( 'modules/link-pages' );
	}

	/**
	 * ページ見出しを表示
	 *
	 * @param int|null $post_id
	 */
	public static function the_title( $post_id = null ) {
		$post    = get_post( $post_id );
		$post_id = isset( $post->ID ) ? $post->ID : 0;
		if ( !$post_id ) {
			return;
		}
		do_action( 'habakiri_before_title' );
		?>
		<?php if ( is_page() ) : ?>
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
	 * site_branding のサイズを取得
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
	 * global navigation wrapper のサイズを取得
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
	 * responsive_nav <> offcanvas_nav 切り替えの breakpoint を取得
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
