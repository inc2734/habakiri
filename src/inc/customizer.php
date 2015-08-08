<?php
/**
 * Name       : Habakiri_Customizer
 * Version    : 1.3.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Customizer {

	/**
	 * デフォルトテーマオプション
	 * @var array
	 */
	protected static $defaults = array();

	/**
	 * ヘッダーの選択肢
	 * @var array
	 */
	protected $header_choices = array();

	/**
	 * ヘッダー固定の選択肢
	 * @var array
	 */
	protected $header_fixed_choices = array();

	/**
	 * フッターのカラム数の選択肢
	 * @var array
	 */
	protected $footer_columns_choices = array();

	/**
	 * ブログのテンプレート
	 * @var array
	 */
	protected $blog_template_choices = array();

	/**
	 * 検索ページのテンプレート
	 * @var array
	 */
	protected $search_template_choices = array();

	/**
	 * 404ページのテンプレート
	 * @var array
	 */
	protected $_404_template_choices = array();

	/**
	 * false, true の選択肢
	 * @var array
	 */
	protected $boolean_choices = array();

	/**
	 * __construct
	 */
	public function __construct() {
		$this->boolean_choices = array(
			'false' => __( 'No', 'habakiri' ),
			'true'  => __( 'Yes', 'habakiri' ),
		);

		$this->header_choices = array(
			'header--default' => __( 'Default', 'habakiri' ),
			'header--2row'    => __( '2 rows', 'habakiri' ),
			'header--center'  => __( 'Center Logo', 'habakiri' ),
		);
		$this->header_fixed_choices = array(
			''             => __( 'No', 'habakiri' ),
			'header--fixed' => __( 'Yes', 'habakiri' ),
		);
		$this->footer_columns_choices = array(
			'col-md-6' => __( '2 Columns', 'habakiri' ),
			'col-md-4' => __( '3 Columns', 'habakiri' ),
			'col-md-3' => __( '4 Columns', 'habakiri' ),
		);
		$this->blog_template_choices = array(
			'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
			'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
			'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
			'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
			'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
		);
		$this->search_template_choices = array(
			'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
			'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
			'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
			'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
			'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
		);
		$this->_404_template_choices = array(
			'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
			'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
			'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
			'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
			'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
		);
	}

	/**
	 * デフォルト値を取得
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get_default( $key ) {
		self::$defaults = apply_filters(
			'habakiri_theme_mods_defaults',
			array(
				'logo'                           => '',
				'logo_text_color'                => '#000',
				'header'                         => 'header--default',
				'header_fixed'                   => '',
				'footer_columns'                 => 'col-md-4',
				'blog_template'                  => 'right-sidebar',
				'search_template'                => 'right-sidebar',
				'404_template'                   => 'right-sidebar',
				'is_displaying_thumbnail'        => 'true',
				'is_displaying_bread_crumb'      => 'true',
				'is_displaying_related_posts'    => 'true',
				'is_displaying_page_header'      => 'true',
				'is_displaying_page_header_lead' => 'true',
				'link_color'                     => '#337ab7',
				'link_hover_color'               => '#23527c',
				'gnav_link_color'                => '#000',
				'gnav_link_hover_color'          => '#337ab7',
				'gnav_pulldown_link_color'       => '#777',
				'gnav_pulldown_bg_color'         => '#000',
				'gnav_pulldown_bg_hover_color'   => '#191919',
				'header_bg_color'                => '#fff',
				'footer_bg_color'                => '#111113',
				'footer_text_color'              => '#555',
				'footer_link_color'              => '#777',
				'page_header_bg_color'           => '#222',
				'page_header_text_color'         => '#fff',
			)
		);
		if ( isset( self::$defaults[$key] ) ) {
			return self::$defaults[$key];
		}
	}

	/**
	 * テーマカスタマイザーにオリジナル項目を設定
	 *
	 * @param WP_Customizer $wp_customize
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_section( 'habakiri_design', array(
			'title'    => __( 'settings', 'habakiri' ),
			'priority' => 100,
		) );

		$wp_customize->add_setting( 'logo', array(
			'default'           => self::get_default( 'logo' ),
			'sanitize_callback' => array( $this, 'sanitize_image_url' ),
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'    => __( 'Logo', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'logo',
		) ) );

		$wp_customize->add_setting( 'logo_text_color', array(
			'default'           => self::get_default( 'logo_text_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logo_text_color', array(
			'label'    => __( 'Logo Text Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'logo_text_color',
		) ) );

		$wp_customize->add_setting( 'header', array(
			'default'           => self::get_default( 'header' ),
			'sanitize_callback' => array( $this, 'sanitize_header' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header', array(
			'label'    => __( 'Header', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'header',
			'type'     => 'radio',
			'choices'  => $this->header_choices,
		) ) );

		$wp_customize->add_setting( 'header_fixed', array(
			'default'           => self::get_default( 'header_fixed' ),
			'sanitize_callback' => array( $this, 'sanitize_header_fixed' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_fixed', array(
			'label'    => __( 'Header Fixed', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'header_fixed',
			'type'     => 'radio',
			'choices'  => $this->header_fixed_choices,
		) ) );

		$wp_customize->add_setting( 'footer_columns', array(
			'default'           => self::get_default( 'footer_columns' ),
			'sanitize_callback' => array( $this, 'sanitize_footer_columns' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_columns', array(
			'label'    => __( 'Number of footer columns', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'footer_columns',
			'type'     => 'radio',
			'choices'  => $this->footer_columns_choices,
		) ) );

		$wp_customize->add_setting( 'blog_template', array(
			'default'           => self::get_default( 'blog_template' ),
			'sanitize_callback' => array( $this, 'sanitize_blog_template' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_template', array(
			'label'    => __( 'Blog Template', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'blog_template',
			'type'     => 'radio',
			'choices'  => $this->blog_template_choices,
		) ) );

		$wp_customize->add_setting( 'search_template', array(
			'default'           => self::get_default( 'search_template' ),
			'sanitize_callback' => array( $this, 'sanitize_search_template' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'search_template', array(
			'label'    => __( 'Search Template', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'search_template',
			'type'     => 'radio',
			'choices'  => $this->search_template_choices,
		) ) );

		$wp_customize->add_setting( '404_template', array(
			'default'           => self::get_default( '404_template' ),
			'sanitize_callback' => array( $this, 'sanitize_404_template' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, '404_template', array(
			'label'    => __( '404 Template', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => '404_template',
			'type'     => 'radio',
			'choices'  => $this->_404_template_choices,
		) ) );

		$wp_customize->add_setting( 'is_displaying_thumbnail', array(
			'default'           => self::get_default( 'is_displaying_thumbnail' ),
			'sanitize_callback' => array( $this, 'sanitize_is_displaying_thumbnail' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_displaying_thumbnail', array(
			'label'    => __( 'Displaying thumbnail in archive page', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'is_displaying_thumbnail',
			'type'     => 'radio',
			'choices'  => $this->boolean_choices,
		) ) );

		$wp_customize->add_setting( 'is_displaying_bread_crumb', array(
			'default'           => self::get_default( 'is_displaying_bread_crumb' ),
			'sanitize_callback' => array( $this, 'sanitize_is_displaying_bread_crumb' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_displaying_bread_crumb', array(
			'label'    => __( 'Displaying the Bread Crumb', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'is_displaying_bread_crumb',
			'type'     => 'radio',
			'choices'  => $this->boolean_choices,
		) ) );

		$wp_customize->add_setting( 'is_displaying_related_posts', array(
			'default'           => self::get_default( 'is_displaying_related_posts' ),
			'sanitize_callback' => array( $this, 'sanitize_is_displaying_related_posts' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_displaying_related_posts', array(
			'label'    => __( 'Displaying related posts in single page', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'is_displaying_related_posts',
			'type'     => 'radio',
			'choices'  => $this->boolean_choices,
		) ) );

		$wp_customize->add_setting( 'is_displaying_page_header', array(
			'default'           => self::get_default( 'is_displaying_page_header' ),
			'sanitize_callback' => array( $this, 'sanitize_is_displaying_page_header' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_displaying_page_header', array(
			'label'    => __( 'Displaying page header', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'is_displaying_page_header',
			'type'     => 'radio',
			'choices'  => $this->boolean_choices,
		) ) );

		$wp_customize->add_setting( 'is_displaying_page_header_lead', array(
			'default'           => self::get_default( 'is_displaying_page_header_lead' ),
			'sanitize_callback' => array( $this, 'sanitize_is_displaying_page_header_lead' ),
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_displaying_page_header_lead', array(
			'label'    => __( 'Displaying lead of page header in single page', 'habakiri' ),
			'section'  => 'habakiri_design',
			'settings' => 'is_displaying_page_header_lead',
			'type'     => 'radio',
			'choices'  => $this->boolean_choices,
		) ) );

		$wp_customize->add_setting( 'link_color', array(
			'default'           => self::get_default( 'link_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'    => __( 'Link Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'link_color',
		) ) );

		$wp_customize->add_setting( 'link_hover_color', array(
			'default'           => self::get_default( 'link_hover_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
			'label'    => __( 'Link Hover Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'link_hover_color',
		) ) );

		$wp_customize->add_setting( 'gnav_link_color', array(
			'default'           => self::get_default( 'gnav_link_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gnav_link_color', array(
			'label'    => __( 'Global Navigation Link Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'gnav_link_color',
		) ) );

		$wp_customize->add_setting( 'gnav_link_hover_color', array(
			'default'           => self::get_default( 'gnav_link_hover_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gnav_link_hover_color', array(
			'label'    => __( 'Global Navigation Link Hover Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'gnav_link_hover_color',
		) ) );

		$wp_customize->add_setting( 'gnav_pulldown_link_color', array(
			'default'           => self::get_default( 'gnav_pulldown_link_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gnav_pulldown_link_color', array(
			'label'    => __( 'Global Navigation Pulldown Link Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'gnav_pulldown_link_color',
		) ) );

		$wp_customize->add_setting( 'gnav_pulldown_bg_color', array(
			'default'           => self::get_default( 'gnav_pulldown_bg_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gnav_pulldown_bg_color', array(
			'label'    => __( 'Global Navigation Pulldown Background Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'gnav_pulldown_bg_color',
		) ) );

		$wp_customize->add_setting( 'gnav_pulldown_bg_hover_color', array(
			'default'           => self::get_default( 'gnav_pulldown_bg_hover_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gnav_pulldown_bg_hover_color', array(
			'label'    => __( 'Global Navigation Pulldown Background Hover Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'gnav_pulldown_bg_hover_color',
		) ) );

		$wp_customize->add_setting( 'header_bg_color', array(
			'default'           => self::get_default( 'header_bg_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
			'label'    => __( 'Header Background Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'header_bg_color',
		) ) );

		$wp_customize->add_setting( 'footer_bg_color', array(
			'default'           => self::get_default( 'footer_bg_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
			'label'    => __( 'Footer Background Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'footer_bg_color',
		) ) );

		$wp_customize->add_setting( 'footer_text_color', array(
			'default'           => self::get_default( 'footer_text_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
			'label'    => __( 'Footer Text Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'footer_text_color',
		) ) );

		$wp_customize->add_setting( 'footer_link_color', array(
			'default'           => self::get_default( 'footer_link_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color', array(
			'label'    => __( 'Footer Link Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'footer_link_color',
		) ) );

		$wp_customize->add_setting( 'page_header_bg_color', array(
			'default'           => self::get_default( 'page_header_bg_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_header_bg_color', array(
			'label'    => __( 'Page Header Background Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'page_header_bg_color',
		) ) );

		$wp_customize->add_setting( 'page_header_text_color', array(
			'default'           => self::get_default( 'page_header_text_color' ),
			'sanitize_callback' => array( $this, 'sanitize_colorcode' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_header_text_color', array(
			'label'    => __( 'Page Header Text Color', 'habakiri' ),
			'section'  => 'colors',
			'settings' => 'page_header_text_color',
		) ) );
	}

	/**
	 * CSS を出力
	 */
	public function customize_css() {
		?>
		<style>
		a {
			color: <?php echo esc_html( Habakiri::get( 'link_color' ) ); ?>;
		}
		a:focus, a:active, a:hover {
			color: <?php echo esc_html( Habakiri::get( 'link_hover_color' ) ); ?>;
		}
		.site-branding a {
			color: <?php echo esc_html( Habakiri::get( 'logo_text_color' ) ); ?>;
		}
		.global-nav a {
			color: <?php echo esc_html( Habakiri::get( 'gnav_link_color' ) ); ?>;
		}
		.global-nav a:hover,
		.global-nav a:active,
		.global-nav ul li.current-menu-item > a,
		.global-nav ul li.current-menu-ancestor > a,
		.global-nav ul li.current-menu-parent > a,
		.global-nav ul li.current_page_item > a,
		.global-nav ul li.current_page_parent > a {
			color: <?php echo esc_html( Habakiri::get( 'gnav_link_hover_color' ) ); ?>;
		}
		.global-nav .sub-menu a,
		.global-nav .children a {
			background-color: <?php echo esc_html( Habakiri::get( 'gnav_pulldown_bg_color' ) ); ?>;
			color: <?php echo esc_html( Habakiri::get( 'gnav_pulldown_link_color' ) ); ?>;
		}
		.global-nav .sub-menu a:hover,
		.global-nav .children a:active,
		.global-nav .children .current-menu-item,
		.global-nav .children .current-menu-ancestor,
		.global-nav .children .current-menu-parent,
		.global-nav .children .current_page_item,
		.global-nav .children .current_page_parent {
			background-color: <?php echo esc_html( Habakiri::get( 'gnav_pulldown_bg_hover_color' ) ); ?>;
		}
		.entry--has_media__link--text {
			background-color: <?php echo esc_html( Habakiri::get( 'link_color' ) ); ?>;
		}
		.page-header {
			background-color: <?php echo esc_html( Habakiri::get( 'page_header_bg_color' ) ); ?>;
			color: <?php echo esc_html( Habakiri::get( 'page_header_text_color' ) ); ?>;
		}
		.pagination>li>a {
			color: <?php echo esc_html( Habakiri::get( 'link_color' ) ); ?>;
		}
		.pagination>li>span {
			background-color: <?php echo esc_html( Habakiri::get( 'link_color' ) ); ?>;
			border-color: <?php echo esc_html( Habakiri::get( 'link_color' ) ); ?>;
		}
		.pagination>li>a:focus,
		.pagination>li>a:hover,
		.pagination>li>span:focus,
		.pagination>li>span:hover {
			color: <?php echo esc_html( Habakiri::get( 'link_hover_color' ) ); ?>;
		}
		#header {
			background-color: <?php echo esc_html( Habakiri::get( 'header_bg_color' ) ); ?>;
		}
		#footer {
			background-color: <?php echo esc_html( Habakiri::get( 'footer_bg_color' ) ); ?>;
		}
		#footer .footer-widget-area,
		#footer .footer-widget-area .widget_calendar #wp-calendar caption {
			color: <?php echo esc_html( Habakiri::get( 'footer_text_color' ) ); ?>;
		}
		#footer .footer-widget-area a {
			color: <?php echo esc_html( Habakiri::get( 'footer_link_color' ) ); ?>;
		}
		#footer .footer-widget-area .widget_calendar #wp-calendar,
		#footer .footer-widget-area .widget_calendar #wp-calendar * {
			border-color: <?php echo esc_html( Habakiri::get( 'footer_text_color' ) ); ?>;
		}
		</style>
		<?php
	}

	/**
	 * 画像 URL のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_image_url( $value ) {
		if ( preg_match( '/^' . preg_quote( home_url(), '/' ) . '\/.+?\.(gif|jpg|jpeg|bmp|png)$/', $value ) ) {
			return $value;
		}
		return false;
	}

	/**
	 * カラーコードのサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_colorcode( $value ) {
		if ( preg_match( '/^#([\da-fA-F]{6}|[\da-fA-F]{3})$/', $value ) ) {
			return $value;
		}
		return false;
	}

	/**
	 * 選択肢項目のサニタイズ
	 *
	 * @param bool|string|int $value 選択肢のキー
	 * @param array $choices キー => ラベル の配列
	 * @param string $default デフォルト値
	 * @return string
	 */
	protected function sanitize_choices( $value, $choices, $default ) {
		if ( array_key_exists( $value, $choices ) ) {
			return $value;
		}
		return $default;
	}

	/**
	 * header のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_header( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->header_choices,
			self::get_default( 'header' )
		);
	}

	/**
	 * header_fixed のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_header_fixed( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->header_fixed_choices,
			self::get_default( 'header_fixed' )
		);
	}

	/**
	 * footer_columns のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_footer_columns( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->footer_columns_choices,
			self::get_default( 'footer_columns' )
		);
	}

	/**
	 * blog_template のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_blog_template( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->blog_template_choices,
			self::get_default( 'blog_template' )
		);
	}

	/**
	 * search_template のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_search_template( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->search_template_choices,
			self::get_default( 'search_template' )
		);
	}

	/**
	 * 404_template のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_404_template( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->_404_template_choices,
			self::get_default( '404_template' )
		);
	}

	/**
	 * is_displaying_thumbnail のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_is_displaying_thumbnail( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->boolean_choices,
			self::get_default( 'is_displaying_thumbnail' )
		);
	}

	/**
	 * is_displaying_bread_crumb のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_is_displaying_bread_crumb( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->boolean_choices,
			self::get_default( 'is_displaying_bread_crumb' )
		);
	}

	/**
	 * is_displaying_related_posts のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_is_displaying_related_posts( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->boolean_choices,
			self::get_default( 'is_displaying_related_posts' )
		);
	}

	/**
	 * is_displaying_page_header のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_is_displaying_page_header( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->boolean_choices,
			self::get_default( 'is_displaying_page_header' )
		);
	}

	/**
	 * is_displaying_page_header_lead のサニタイズ
	 *
	 * @param string $value
	 * @return string $value
	 */
	public function sanitize_is_displaying_page_header_lead( $value ) {
		return $this->sanitize_choices(
			$value,
			$this->boolean_choices,
			self::get_default( 'is_displaying_page_header_lead' )
		);
	}
}
