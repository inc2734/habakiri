<?php
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/class.bread-crumb.php';
require_once get_template_directory() . '/inc/class.entry-meta.php';
require_once get_template_directory() . '/inc/class.related-posts.php';

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
 * Version    : 1.1.2
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : July 8, 2015
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class Habakiri_Base_Functions {

	/**
	 * __construct
	 */
	public function __construct() {
		global $content_width;
		if ( !isset( $content_width ) ) $content_width = 940;
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

		add_action( 'widgets_init'        , array( $this, 'register_sidebar' ) );
		add_action( 'wp_enqueue_scripts'  , array( $this, 'wp_enqueue_scripts' ) );

		add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) );
		add_filter( 'body_class'          , array( $this, 'body_class' ) );
	}

	/**
	 * 管理画面の wysiwyg エディタに class を追加
	 *
	 * @param array $init
	 * @return array
	 */
	function tiny_mce_before_init( $init ){
		$init['body_class'] = 'entry-content';
		return $init;
	}

	/**
	 * カスタマイザーに設定を追加
	 */
	protected function customizer() {
		$Customizer = new Habakiri_Customizer();
		add_action( 'customize_register', array( $Customizer, 'customize_register' ) );
		add_action( 'wp_head'           , array( $Customizer, 'customize_css' ) );
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
	 * ウィジェットエリアを追加
	 */
	public function register_sidebar() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'habakiri' ),
			'id'            => 'sidebar',
			'description'   => __( 'Sidebar', 'habakiri' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer', 'habakiri' ),
			'id'            => 'footer-widget-area',
			'description'   => __( 'Footer Widget Area', 'habakiri' ),
			'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
			'after_widget'  => '</div>',
		) );

		add_action( 'wp_head', array( $this, 'add_footer_widget_class' ) );
	}

	/**
	 * フッターウィジェットの class を追加
	 */
	public function add_footer_widget_class() {
		?>
		<script>
		jQuery( function( $ ) {
			$( '#footer .widget' )
				.removeClass( 'col-md-4' )
				.addClass( '<?php echo esc_js( Habakiri::get( 'footer_columns' ) ); ?>' );
		} );
		</script>
		<?php
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
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<dl id="comment-<?php comment_ID(); ?>" class="comment-item">
				<dt class="comment-header">
					<div class="comment-author">
						<?php echo get_avatar( $comment, '48' ); ?>
					<!-- end .comment-author --></div>
				</dt>
				<dd class="comment-body">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'habakiri' ) ?></em>
					<?php endif; ?>
					<div class="comment-meta commentmetadata vcard">
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
					<div class="reply btn btn-sm btn-primary">
						<?php echo $comment_reply_link; ?>
					<!-- end .reply --></div>
					<?php endif; ?>
				</dd>
			</dl>
		<?php
	}

	/**
	 * copyright を出力
	 */
	public static function the_copyright() {
		$theme_url     = 'http://2inc.org';
		$wordpress_url = 'http://wordpress.org/';
		$theme_link = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			esc_url( $theme_url ),
			__( 'Monkey Wrench', 'habakiri' )
		);
		$wordpress_link = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			esc_url( $wordpress_url ),
			__( 'WordPress', 'habakiri' )
		);
		$theme_by   = sprintf( __( 'Habakiri theme by %s', 'habakiri' ), $theme_link );
		$powered_by = sprintf( __( 'Powered by %s', 'habakiri' ), $wordpress_link );
		$copyright  = sprintf(
			'%s&nbsp;%s',
			$theme_by,
			$powered_by
		);

		echo apply_filters( 'habakiri_copyright', $copyright );
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
	 * テーマオプションを取得
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get( $key ) {
		$default   = Habakiri_Customizer::get_default( $key );
		$theme_mod = get_theme_mod( $key );
		if ( $theme_mod ) {
			return $theme_mod;
		}
		return $default;
	}

	/**
	 * ヘッダーが1行かどうか
	 *
	 * @return bool
	 */
	public static function is_one_row_header() {
		$headers = array( 'header-default' );
		if ( in_array( Habakiri::get( 'header' ), $headers ) ) {
			return true;
		}
		return false;
	}


	/**
	 * ロゴを表示
	 */
	public static function the_logo() {
		$header_logo = Habakiri::get( 'logo' );
		if ( $header_logo ) {
			$header_logo = sprintf(
				'<img src="%s" alt="%s" />',
				esc_url( $header_logo ),
				get_bloginfo( 'name' )
			);
		} else {
			$header_logo = get_bloginfo( 'name' );
		}
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo $header_logo; ?>
		</a>
		<?php
	}

	/**
	 * ページヘッダーを表示
	 *
	 * @param int $post_id
	 */
	public static function the_page_header( $post_id = null ) {
		if ( Habakiri::get( 'is_displaying_page_header' ) === 'false' ) {
			return;
		}

		global $post;

		$title = get_the_title( $post_id );
		if ( is_404() ) {
			$title = __( 'Woops! Page not found.', 'habakiri' );
		} elseif ( is_search() ) {
			$title = sprintf( __( 'Search Results for: %s', 'habakiri' ), get_search_query() );
		}

		$class = '';
		if ( !is_single() ) {
			$class = 'entry-title';
		}
		$class = apply_filters( 'habakiri_title_class_in_page_header', $class );
		?>
		<div class="page-header text-center" <?php if ( get_header_image() ) : ?>style="background-image: url( <?php header_image(); ?> )"<?php endif; ?>>
			<div class="container">
				<h1 <?php if ( !empty( $class ) ) : ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?>>
					<?php echo apply_filters( 'habakiri_title_in_page_header', esc_html( $title ) ); ?>
				</h1>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( is_page() && get_the_excerpt() && !empty( $post->post_excerpt ) && Habakiri::get( 'is_displaying_page_header_lead' ) !== 'false' ) : ?>
				<div class="page-header-description">
					<?php the_excerpt(); ?>
				<!-- end .page-description --></div>
				<?php endif; ?>
				<?php endwhile; ?>
			<!-- end .container --></div>
		<!-- end .page-header --></div>
		<?php
	}

	/**
	 * パンくずリストを表示
	 */
	public static function the_bread_crumb() {
		if ( !is_front_page() ) {
			$BreadCrumb = new Habakiri_Bread_Crumb();
			$BreadCrumb->display();
		}
	}

	/**
	 * サムネイルを表示
	 */
	public static function the_post_thumbnail() {
		$classes = array(
			'img-circle',
		);
		if ( !has_post_thumbnail() ) {
			$classes[] = 'no-thumbnail';
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
				<span class="no-thumbnail-text">
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
		$RelatedPosts = new Habakiri_Related_Posts();
		$RelatedPosts->display();
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
		global $wp_rewrite;
		global $wp_query;
		global $paged;
		$paginate_base = get_pagenum_link( 1 );
		if ( strpos( $paginate_base, '?' ) || ! $wp_rewrite->using_permalinks() ) {
			$paginate_format = '';
			$paginate_base = add_query_arg( 'paged', '%#%' );
		} else {
			$paginate_format = ( substr( $paginate_base, -1 ,1 ) == '/' ? '' : '/' ) .
			user_trailingslashit( 'page/%#%/', 'paged' );
			$paginate_base .= '%_%';
		}
		$paginate_links = paginate_links( array(
			'base'      => $paginate_base,
			'format'    => $paginate_format,
			'total'     => $wp_query->max_num_pages,
			'mid_size'  => 5,
			'current'   => ( $paged ? $paged : 1 ),
			'prev_text' => '&lt;',
			'next_text' => '&gt;',
			'type'      => 'array',
		) );
		if ( $paginate_links ) {
			?>
			<nav>
				<ul class="pagination">
					<?php foreach ( $paginate_links as $link ) : ?>
					<li><?php echo $link; ?></li>
					<?php endforeach; ?>
				</ul>
			</nav>
			<?php
		}
	}

	/**
	 * エントリーメタを表示
	 */
	public static function the_entry_meta() {
		$EnetryMeta = new Habakiri_Entry_Meta();
		$EnetryMeta->display();
	}

	/**
	 * ページ分割
	 */
	public static function the_link_pages() {
		wp_link_pages( array(
			'before'           => '<nav><ul class="pagination"><li>',
			'after'            => '</li></ul></nav>',
			'link_before'      => '',
			'link_after'       => '',
			'separator'        => '</li><li>',
			'nextpagelink'     => '&gt;',
			'previouspagelink' => '%lt;',
			'pagelink'         => '<span>%</span>',
		) );
	}

	/**
	 * ページ見出しを表示
	 *
	 * @param int|null $post_id
	 */
	public static function the_title( $post_id = null ) {
		global $post;
		if ( !is_null( $post_id ) ) {
			$post = get_post( $post_id );
			setup_postdata( $post );
		}
		do_action( 'habakiri_before_title' );
		?>
		<?php if ( is_page_template( 'templates/front-page.php' ) ) : ?>
		<h1 class="entry-title hidden"><?php the_title(); ?></h1>
		<?php elseif ( is_singular() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php endif; ?>
		<?php
		do_action( 'habakiri_after_title' );
		wp_reset_postdata();
	}
}
