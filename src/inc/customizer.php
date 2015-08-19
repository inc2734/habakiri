<?php
/**
 * Name       : Habakiri_Customizer
 * Version    : 1.4.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 18, 2015
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
				'gnav_breakpoint'                => 'md',
				'slider_option_effect'           => 'horizontal',
				'slider_option_interval'         => 4000,
				'slider_option_speed'            => 500,
				'slider_option_overlay_color'    => '#000',
				'slider_option_overlay_opacity'  => '100',
				'slider_option_height'           => 0,
				'slider_option_target_1'         => false,
				'slider_option_target_2'         => false,
				'slider_option_target_3'         => false,
				'slider_option_target_4'         => false,
				'slider_option_target_5'         => false,
			)
		);
		if ( isset( self::$defaults[$key] ) ) {
			return self::$defaults[$key];
		}
	}

	/**
	 * テーマカスタマイザーにオリジナル項目を設定
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	public function customize_register( $wp_customize ) {
		require_once get_template_directory() . '/inc/class.habakiri-customizer-framework.php';
		$Customizer_Framework = new Habakiri_Customizer_Framework( $wp_customize );

		// colors

		$Customizer_Framework->color( 'logo_text_color', array(
			'label'   => __( 'Logo Text Color', 'habakiri' ),
			'default' => self::get_default( 'logo_text_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'link_color', array(
			'label'   => __( 'Link Color', 'habakiri' ),
			'default' => self::get_default( 'link_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'link_hover_color', array(
			'label'   => __( 'Link Hover Color', 'habakiri' ),
			'default' => self::get_default( 'link_hover_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'gnav_link_color', array(
			'label'   => __( 'Global Navigation Link Color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'gnav_link_hover_color', array(
			'label'   => __( 'Global Navigation Link Hover Color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_hover_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'gnav_pulldown_link_color', array(
			'label'   => __( 'Global Navigation Pulldown Link Color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_link_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'gnav_pulldown_bg_color', array(
			'label'   => __( 'Global Navigation Pulldown Background Color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_bg_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'gnav_pulldown_bg_hover_color', array(
			'label'   => __( 'Global Navigation Pulldown Background Hover Color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_bg_hover_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'header_bg_color', array(
			'label'   => __( 'Header Background Color', 'habakiri' ),
			'default' => self::get_default( 'header_bg_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'footer_bg_color', array(
			'label'   => __( 'Footer Background Color', 'habakiri' ),
			'default' => self::get_default( 'footer_bg_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'footer_text_color', array(
			'label'   => __( 'Footer Text Color', 'habakiri' ),
			'default' => self::get_default( 'footer_text_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'footer_link_color', array(
			'label'   => __( 'Footer Link Color', 'habakiri' ),
			'default' => self::get_default( 'footer_link_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'page_header_bg_color', array(
			'label'   => __( 'Page Header Background Color', 'habakiri' ),
			'default' => self::get_default( 'page_header_bg_color' ),
			'section' => 'colors',
		) );

		$Customizer_Framework->color( 'page_header_text_color', array(
			'label'   => __( 'Page Header Text Color', 'habakiri' ),
			'default' => self::get_default( 'page_header_text_color' ),
			'section' => 'colors',
		) );

		// habakiri_design

		$Customizer_Framework->add_section( 'habakiri_design', array(
			'title'    => __( 'Settings', 'habakiri' ),
			'priority' => 100,
		) );

		$Customizer_Framework->image( 'logo', array(
			'label'   => __( 'Logo', 'habakiri' ),
			'section' => 'habakiri_design',
		) );

		$Customizer_Framework->radio( 'is_displaying_thumbnail', array(
			'label'   => __( 'Displaying thumbnail in archive page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_thumbnail' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'is_displaying_bread_crumb', array(
			'label'   => __( 'Displaying the Bread Crumb', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_bread_crumb' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'is_displaying_related_posts', array(
			'label'   => __( 'Displaying related posts in single page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_related_posts' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'is_displaying_page_header', array(
			'label'   => __( 'Displaying page header', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_page_header' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'is_displaying_page_header_lead', array(
			'label'   => __( 'Displaying lead of page header in single page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_page_header_lead' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		// habakiri_layout

		$Customizer_Framework->radio( 'gnav_breakpoint', array(
			'label'   => __( 'Breakpoint to switch off canvas navigation', 'habakiri' ),
			'default' => self::get_default( 'gnav_breakpoint' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				''   => __( 'Always', 'habakiri' ),
				'md' => __( 'Tablet size', 'habakiri' ),
				'lg' => __( 'Laptop size', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'header', array(
			'label'   => __( 'Header', 'habakiri' ),
			'default' => self::get_default( 'header' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				'header--default'      => __( 'Default', 'habakiri' ),
				'header--2row'         => __( '2 rows', 'habakiri' ),
				'header--center'       => __( 'Center Logo', 'habakiri' ),
				'header--transparency' => __( 'Transparency', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'header_fixed', array(
			'label'   => __( 'Header Fixed', 'habakiri' ),
			'default' => self::get_default( 'header_fixed' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				''              => __( 'No', 'habakiri' ),
				'header--fixed' => __( 'Yes', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'footer_columns', array(
			'label'   => __( 'Number of footer columns', 'habakiri' ),
			'default' => self::get_default( 'footer_columns' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				'col-md-6' => __( '2 Columns', 'habakiri' ),
				'col-md-4' => __( '3 Columns', 'habakiri' ),
				'col-md-3' => __( '4 Columns', 'habakiri' ),
			),
		) );

		$Customizer_Framework->add_section( 'habakiri_layout', array(
			'title'    => __( 'Layout', 'habakiri' ),
			'priority' => 101,
		) );

		$Customizer_Framework->radio( 'blog_template', array(
			'label'   => __( 'Blog Template', 'habakiri' ),
			'default' => self::get_default( 'blog_template' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( 'search_template', array(
			'label'   => __( 'Search Template', 'habakiri' ),
			'default' => self::get_default( 'search_template' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		$Customizer_Framework->radio( '404_template', array(
			'label'   => __( '404 Template', 'habakiri' ),
			'default' => self::get_default( '404_template' ),
			'section' => 'habakiri_layout',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		// habakiri_slider

		$Customizer_Framework->add_panel( 'habakiri_slider', array(
			'title'    => __( 'Front page Slider', 'habakiri' ),
			'priority' => 102,
		) );

		$Customizer_Framework->add_section( 'habakiri_slider_option', array(
			'title' =>  __( 'Settings', 'habakiri' ),
			'panel' => 'habakiri_slider',
		) );

		$Customizer_Framework->radio( 'slider_option_effect', array(
			'label'   => __( 'Effect', 'habakiri' ),
			'default' => self::get_default( 'slider_option_effect' ),
			'section' => 'habakiri_slider_option',
			'choices' => array(
				'horizontal' => __( 'Slide', 'habakiri' ),
				'fade'       => __( 'Fade', 'habakiri' ),
			),
		) );

		$Customizer_Framework->number( 'slider_option_interval', array(
			'label'   => __( 'Interval (ms)', 'habakiri' ),
			'default' => self::get_default( 'slider_option_interval' ),
			'section' => 'habakiri_slider_option',
		) );

		$Customizer_Framework->number( 'slider_option_speed', array(
			'label'   => __( 'Effect Speed (ms)', 'habakiri' ),
			'default' => self::get_default( 'slider_option_speed' ),
			'section' => 'habakiri_slider_option',
		) );

		$Customizer_Framework->color( 'slider_option_overlay_color', array(
			'label'   => __( 'Overlay color', 'habakiri' ),
			'default' => self::get_default( 'slider_option_overlay_color' ),
			'section' => 'habakiri_slider_option',
		) );

		$Customizer_Framework->range( 'slider_option_overlay_opacity', array(
			'label'   => __( 'Overlay opacity', 'habakiri' ),
			'default' => self::get_default( 'slider_option_overlay_opacity' ),
			'section' => 'habakiri_slider_option',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		) );

		$Customizer_Framework->number( 'slider_option_height', array(
			'label'       => __( 'Height (px)', 'habakiri' ),
			'default'     => self::get_default( 'slider_option_height' ),
			'section'     => 'habakiri_slider_option',
			'description' => __( 'If 0, height is auto.', 'habakiri' ),
		) );

		for ( $i = 1; $i <= 5; $i ++ ) {
			$section_id = 'habakiri_slider_image_' . $i;
			$Customizer_Framework->add_section( $section_id, array(
				'title' =>  sprintf( __( 'Image (%d)', 'habakiri' ), $i ),
				'panel' => 'habakiri_slider',
			) );
			$Customizer_Framework->image( 'slider_image_' . $i, array(
				'label'   => __( 'Image', 'habakiri' ),
				'section' => $section_id,
			) );
			$Customizer_Framework->textarea( 'slider_content_' . $i, array(
				'label'   => __( 'Content', 'habakiri' ),
				'section' => $section_id,
			) );
			$Customizer_Framework->url( 'slider_url_' . $i, array(
				'label'   => __( 'URL', 'habakiri' ),
				'section' => $section_id,
			) );
			$Customizer_Framework->checkbox( 'slider_target_' . $i, array(
				'label'   => __( 'Open link in new window', 'habakiri' ),
				'default' => self::get_default( 'slider_target_' . $i ),
				'section' => $section_id,
			) );
		}
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
		.global-nav a,
		#responsive-btn {
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
		<?php if ( $gnav_min_width = Habakiri::get_gnav_min_width() ) : ?>
		@media ( min-width: <?php echo esc_html( $gnav_min_width ); ?>px ) {
			.responsive-nav {
				display: block !important;
			}
			.off-canvas-nav,
			#responsive-btn {
				display: none !important;
			}
			.header--default {
				padding-top: 10px;
				padding-bottom: 10px;
			}
			.header--2row {
				padding-bottom: 0;
			}
			.header--2row .header__col,
			.header--center .header__col {
				display: block;
			}
			.header--2row .site-branding {
				margin-bottom: 0;
			}
			.header--center .site-branding {
				margin-top: 20px;
				margin-bottom: 20px;
				text-align: center;
			}
		}
		<?php endif; ?>
		.habakiri-slider {
			background-color: <?php echo esc_html( Habakiri::get( 'slider_option_overlay_color' ) ); ?>;
		}
		.habakiri-slider__image {
			opacity: <?php echo esc_html( Habakiri::get( 'slider_option_overlay_opacity' ) / 100 ); ?>;
		}
		<?php if ( Habakiri::get( 'slider_option_height' ) ) : ?>
		.habakiri-slider .bx-wrapper,
		.habakiri-slider__item {
			max-height: <?php echo esc_html( Habakiri::get( 'slider_option_height' ) ); ?>px;
			overflow: hidden;
		}
		<?php endif; ?>
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
		#header.header--transparency--is_scrolled {
			background-color: <?php echo esc_html( Habakiri::get( 'header_bg_color' ) ); ?> !important;
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
}
