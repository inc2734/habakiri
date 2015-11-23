<?php
/**
 * Name       : Habakiri_Customizer
 * Version    : 1.5.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : October 10, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Customizer {

	/**
	 * Default theme options
	 * @var array
	 */
	protected static $defaults = array();

	/**
	 * @var Habakiri_Customizer_Framework
	 */
	protected $Customizer_Framework;

	public function __construct() {
		$this->Customizer_Framework = new Habakiri_Customizer_Framework();
	}

	/**
	 * Return default value
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get_default( $key ) {
		self::$defaults = apply_filters(
			'habakiri_theme_mods_defaults',
			array(
				'logo'                             => '',
				'logo_text_color'                  => '#000',
				'header'                           => 'header--default',
				'header_fixed'                     => '',
				'footer_columns'                   => 'col-md-4',
				'blog_template'                    => 'right-sidebar',
				'search_template'                  => 'right-sidebar',
				'404_template'                     => 'right-sidebar',
				'is_displaying_thumbnail'          => 'true',
				'is_displaying_bread_crumb'        => 'true',
				'is_displaying_related_posts'      => 'true',
				'is_displaying_page_header'        => 'true',
				'is_displaying_page_header_lead'   => 'true',
				'link_color'                       => '#337ab7',
				'link_hover_color'                 => '#23527c',
				'gnav_bg_color'                    => '#fff',
				'gnav_link_color'                  => '#000',
				'gnav_link_hover_color'            => '#337ab7',
				'gnav_link_bg_color'               => '#fff',
				'gnav_link_bg_hover_color'         => '#fff',
				'gnav_sub_label_color'             => '#777',
				'gnav_sub_label_hover_color'       => '#777',
				'gnav_pulldown_link_color'         => '#777',
				'gnav_pulldown_link_hover_color'   => '#337ab7',
				'gnav_pulldown_bg_color'           => '#000',
				'gnav_pulldown_bg_hover_color'     => '#191919',
				'offcanvas_nav_fontsize'           => 12,
				'offcanvas_nav_direction'          => 'right',
				'hamburger_btn_text_color'         => '#000',
				'hamburger_btn_text_hover_color'   => '#000',
				'hamburger_btn_border_color'       => '#eee',
				'hamburger_btn_border_hover_color' => '#eee',
				'hamburger_btn_bg_color'           => '#fff',
				'hamburger_btn_bg_hover_color'     => '#f5f5f5',
				'header_bg_color'                  => '#fff',
				'footer_bg_color'                  => '#111113',
				'footer_text_color'                => '#555',
				'footer_link_color'                => '#777',
				'page_header_bg_color'             => '#222',
				'page_header_text_color'           => '#fff',
				'gnav_breakpoint'                  => 'md',
				'gnav_fontsize'                    => 12,
				'gnav_sub_label_fontsize'          => 10,
				'gnav_link_horizontal_padding'     => 15,
				'gnav_link_vertical_padding'       => 23,
				'slider_option_effect'             => 'horizontal',
				'slider_option_interval'           => 4000,
				'slider_option_speed'              => 500,
				'slider_option_overlay_color'      => '#000',
				'slider_option_overlay_opacity'    => '90',
				'slider_option_height'             => 0,
				'slider_option_target_1'           => false,
				'slider_option_target_2'           => false,
				'slider_option_target_3'           => false,
				'slider_option_target_4'           => false,
				'slider_option_target_5'           => false,
				'excerpt_length'                   => ( get_locale() == 'ja' ) ? 110 : 220,
			)
		);
		if ( isset( self::$defaults[$key] ) ) {
			return self::$defaults[$key];
		}
	}

	/**
	 * Set the original item on the theme customizer
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	public function customize_register( $wp_customize ) {
		$this->Customizer_Framework->register_customizer( $wp_customize );

		// colors

		$this->Customizer_Framework->remove_section( 'colors' );
		$this->Customizer_Framework->add_panel( 'habakiri_colors', array(
			'title'    => __( 'Colors', 'habakiri' ),
			'priority' => 110,
		) );
		
		// colors - general

		$this->Customizer_Framework->add_section( 'colors', array(
			'title' =>  __( 'General', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'logo_text_color', array(
			'label'   => __( 'Logo text color', 'habakiri' ),
			'default' => self::get_default( 'logo_text_color' ),
			'section' => 'colors',
		) );

		$this->Customizer_Framework->color( 'link_color', array(
			'label'   => __( 'Link text color', 'habakiri' ),
			'default' => self::get_default( 'link_color' ),
			'section' => 'colors',
		) );

		$this->Customizer_Framework->color( 'link_hover_color', array(
			'label'   => __( 'Link text hover color', 'habakiri' ),
			'default' => self::get_default( 'link_hover_color' ),
			'section' => 'colors',
		) );

		// colors - header

		$this->Customizer_Framework->add_section( 'colors_header', array(
			'title' =>  __( 'Header', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'header_bg_color', array(
			'label'   => __( 'Background color', 'habakiri' ),
			'default' => self::get_default( 'header_bg_color' ),
			'section' => 'colors_header',
		) );

		// colors - footer

		$this->Customizer_Framework->add_section( 'colors_footer', array(
			'title' =>  __( 'Footer', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'footer_bg_color', array(
			'label'   => __( 'Background color', 'habakiri' ),
			'default' => self::get_default( 'footer_bg_color' ),
			'section' => 'colors_footer',
		) );

		$this->Customizer_Framework->color( 'footer_text_color', array(
			'label'   => __( 'Text color', 'habakiri' ),
			'default' => self::get_default( 'footer_text_color' ),
			'section' => 'colors_footer',
		) );

		$this->Customizer_Framework->color( 'footer_link_color', array(
			'label'   => __( 'Link text color', 'habakiri' ),
			'default' => self::get_default( 'footer_link_color' ),
			'section' => 'colors_footer',
		) );

		// colors - gnav

		$this->Customizer_Framework->add_section( 'colors_gnav', array(
			'title' =>  __( 'Global Navigation', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'gnav_bg_color', array(
			'label'   => __( 'Background color', 'habakiri' ),
			'default' => self::get_default( 'gnav_bg_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_link_color', array(
			'label'   => __( 'Link text color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_link_hover_color', array(
			'label'   => __( 'Link text hover color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_hover_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_link_bg_color', array(
			'label'   => __( 'Menu background color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_bg_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_link_bg_hover_color', array(
			'label'   => __( 'Menu background hover color', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_bg_hover_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_sub_label_color', array(
			'label'   => __( 'Sub label color', 'habakiri' ),
			'default' => self::get_default( 'gnav_sub_label_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_sub_label_hover_color', array(
			'label'   => __( 'Sub label hover color', 'habakiri' ),
			'default' => self::get_default( 'gnav_sub_label_hover_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_pulldown_link_color', array(
			'label'   => __( 'Pulldown link text color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_link_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_pulldown_link_hover_color', array(
			'label'   => __( 'Pulldown link text hover color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_link_hover_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_pulldown_bg_color', array(
			'label'   => __( 'Pulldown menu background color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_bg_color' ),
			'section' => 'colors_gnav',
		) );

		$this->Customizer_Framework->color( 'gnav_pulldown_bg_hover_color', array(
			'label'   => __( 'Pulldown menu background hover color', 'habakiri' ),
			'default' => self::get_default( 'gnav_pulldown_bg_hover_color' ),
			'section' => 'colors_gnav',
		) );

		// colors - hamburger button

		$this->Customizer_Framework->add_section( 'colors_hamburger_button', array(
			'title' =>  __( 'hamburger Button', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_text_color', array(
			'label'   => __( 'Text color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_text_color' ),
			'section' => 'colors_hamburger_button',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_text_hover_color', array(
			'label'   => __( 'Text hover color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_text_hover_color' ),
			'section' => 'colors_hamburger_button',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_border_color', array(
			'label'   => __( 'Border color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_border_color' ),
			'section' => 'colors_hamburger_button',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_border_hover_color', array(
			'label'   => __( 'Border hover color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_border_hover_color' ),
			'section' => 'colors_hamburger_button',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_bg_color', array(
			'label'   => __( 'Background color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_bg_color' ),
			'section' => 'colors_hamburger_button',
		) );

		$this->Customizer_Framework->color( 'hamburger_btn_bg_hover_color', array(
			'label'   => __( 'Background hover color', 'habakiri' ),
			'default' => self::get_default( 'hamburger_btn_bg_hover_color' ),
			'section' => 'colors_hamburger_button',
		) );

		// colors - page header

		$this->Customizer_Framework->add_section( 'colors_page_header', array(
			'title' =>  __( 'Page Header', 'habakiri' ),
			'panel' => 'habakiri_colors',
		) );

		$this->Customizer_Framework->color( 'page_header_bg_color', array(
			'label'   => __( 'Background color', 'habakiri' ),
			'default' => self::get_default( 'page_header_bg_color' ),
			'section' => 'colors_page_header',
		) );

		$this->Customizer_Framework->color( 'page_header_text_color', array(
			'label'   => __( 'Text color', 'habakiri' ),
			'default' => self::get_default( 'page_header_text_color' ),
			'section' => 'colors_page_header',
		) );

		// habakiri_design

		$this->Customizer_Framework->add_section( 'habakiri_design', array(
			'title'    => __( 'Settings', 'habakiri' ),
			'priority' => 111,
		) );

		$this->Customizer_Framework->image( 'logo', array(
			'label'   => __( 'Logo', 'habakiri' ),
			'section' => 'habakiri_design',
		) );

		$this->Customizer_Framework->number( 'excerpt_length', array(
			'label'   => __( 'Excerpt length', 'habakiri' ),
			'default' => self::get_default( 'excerpt_length' ),
			'section' => 'habakiri_design',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->radio( 'is_displaying_thumbnail', array(
			'label'   => __( 'Displaying thumbnail in archive page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_thumbnail' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'is_displaying_bread_crumb', array(
			'label'   => __( 'Displaying the Bread Crumb', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_bread_crumb' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'is_displaying_related_posts', array(
			'label'   => __( 'Displaying related posts in single page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_related_posts' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'is_displaying_page_header', array(
			'label'   => __( 'Displaying page header', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_page_header' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'is_displaying_page_header_lead', array(
			'label'   => __( 'Displaying lead of page header in page', 'habakiri' ),
			'default' => self::get_default( 'is_displaying_page_header_lead' ),
			'section' => 'habakiri_design',
			'choices' => array(
				'false' => __( 'No', 'habakiri' ),
				'true'  => __( 'Yes', 'habakiri' ),
			),
		) );

		// layout
		
		$this->Customizer_Framework->add_panel( 'habakiri_layout', array(
			'title'    => __( 'Layout', 'habakiri' ),
			'priority' => 112,
		) );
		
		// layout - header

		$this->Customizer_Framework->add_section( 'habakiri_layout_header', array(
			'title' =>  __( 'Header', 'habakiri' ),
			'panel' => 'habakiri_layout',
		) );

		$this->Customizer_Framework->radio( 'header', array(
			'label'   => __( 'Header', 'habakiri' ),
			'default' => self::get_default( 'header' ),
			'section' => 'habakiri_layout_header',
			'choices' => array(
				'header--default'      => __( 'Default', 'habakiri' ),
				'header--2row'         => __( '2 rows', 'habakiri' ),
				'header--center'       => __( 'Center Logo', 'habakiri' ),
				'header--transparency' => __( 'Transparency', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'header_fixed', array(
			'label'   => __( 'Header Fixed', 'habakiri' ),
			'default' => self::get_default( 'header_fixed' ),
			'section' => 'habakiri_layout_header',
			'choices' => array(
				''              => __( 'No', 'habakiri' ),
				'header--fixed' => __( 'Yes', 'habakiri' ),
			),
		) );
		
		// layout - footer

		$this->Customizer_Framework->add_section( 'habakiri_layout_footer', array(
			'title' =>  __( 'Footer', 'habakiri' ),
			'panel' => 'habakiri_layout',
		) );
		
		$this->Customizer_Framework->radio( 'footer_columns', array(
			'label'   => __( 'Number of footer columns', 'habakiri' ),
			'default' => self::get_default( 'footer_columns' ),
			'section' => 'habakiri_layout_footer',
			'choices' => array(
				'col-md-6' => __( '2 Columns', 'habakiri' ),
				'col-md-4' => __( '3 Columns', 'habakiri' ),
				'col-md-3' => __( '4 Columns', 'habakiri' ),
			),
		) );
		
		// layout - gnav

		$this->Customizer_Framework->add_section( 'habakiri_layout_gnav', array(
			'title' =>  __( 'Global Navigation', 'habakiri' ),
			'panel' => 'habakiri_layout',
		) );

		$this->Customizer_Framework->radio( 'gnav_breakpoint', array(
			'label'   => __( 'Breakpoint to switch off canvas navigation', 'habakiri' ),
			'default' => self::get_default( 'gnav_breakpoint' ),
			'section' => 'habakiri_layout_gnav',
			'choices' => array(
				''   => __( 'Always', 'habakiri' ),
				'md' => __( 'Tablet size', 'habakiri' ),
				'lg' => __( 'Laptop size', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->number( 'gnav_fontsize', array(
			'label'   => __( 'Font size ( px )', 'habakiri' ),
			'default' => self::get_default( 'gnav_fontsize' ),
			'section' => 'habakiri_layout_gnav',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->number( 'gnav_sub_label_fontsize', array(
			'label'   => __( 'Sub label font size ( px )', 'habakiri' ),
			'default' => self::get_default( 'gnav_sub_label_fontsize' ),
			'section' => 'habakiri_layout_gnav',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->number( 'gnav_link_horizontal_padding', array(
			'label'   => __( 'link padding ( Horizontal )', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_horizontal_padding' ),
			'section' => 'habakiri_layout_gnav',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->number( 'gnav_link_vertical_padding', array(
			'label'   => __( 'link padding ( Vertical )', 'habakiri' ),
			'default' => self::get_default( 'gnav_link_vertical_padding' ),
			'section' => 'habakiri_layout_gnav',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->number( 'offcanvas_nav_fontsize', array(
			'label'   => __( 'Offcanvas Navigation font size ( px )', 'habakiri' ),
			'default' => self::get_default( 'offcanvas_nav_fontsize' ),
			'section' => 'habakiri_layout_gnav',
			'input_attrs' => array(
				'size'  => 3,
				'style' => 'width: 60px;'
			),
		) );

		$this->Customizer_Framework->radio( 'offcanvas_nav_direction', array(
			'label'   => __( 'Offcanvas Navigation slide direction', 'habakiri' ),
			'default' => self::get_default( 'offcanvas_nav_direction' ),
			'section' => 'habakiri_layout_gnav',
			'choices' => array(
				'right' => __( 'Right', 'habakiri' ),
				'left'  => __( 'Left', 'habakiri' ),
			),
		) );
	
		// layout - template

		$this->Customizer_Framework->add_section( 'habakiri_layout_template', array(
			'title' =>  __( 'Template', 'habakiri' ),
			'panel' => 'habakiri_layout',
		) );

		$this->Customizer_Framework->radio( 'blog_template', array(
			'label'   => __( 'Blog Template', 'habakiri' ),
			'default' => self::get_default( 'blog_template' ),
			'section' => 'habakiri_layout_template',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( 'search_template', array(
			'label'   => __( 'Search Template', 'habakiri' ),
			'default' => self::get_default( 'search_template' ),
			'section' => 'habakiri_layout_template',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->radio( '404_template', array(
			'label'   => __( '404 Template', 'habakiri' ),
			'default' => self::get_default( '404_template' ),
			'section' => 'habakiri_layout_template',
			'choices' => array(
				'right-sidebar'    => __( 'Right Sidebar', 'habakiri' ),
				'left-sidebar'     => __( 'Left Sidebar', 'habakiri' ),
				'no-sidebar'       => __( 'No Sidebar', 'habakiri' ),
				'full-width-fixed' => __( 'Full Width ( Fixed )', 'habakiri' ),
				'full-width-fluid' => __( 'Full Width ( Fluid )', 'habakiri' ),
			),
		) );

		// habakiri_slider

		$this->Customizer_Framework->add_panel( 'habakiri_slider', array(
			'title'    => __( 'Front page Slider', 'habakiri' ),
			'priority' => 113,
		) );

		$this->Customizer_Framework->add_section( 'habakiri_slider_option', array(
			'title' =>  __( 'Settings', 'habakiri' ),
			'panel' => 'habakiri_slider',
		) );

		$this->Customizer_Framework->radio( 'slider_option_effect', array(
			'label'   => __( 'Effect', 'habakiri' ),
			'default' => self::get_default( 'slider_option_effect' ),
			'section' => 'habakiri_slider_option',
			'choices' => array(
				'horizontal' => __( 'Slide', 'habakiri' ),
				'fade'       => __( 'Fade', 'habakiri' ),
			),
		) );

		$this->Customizer_Framework->number( 'slider_option_interval', array(
			'label'   => __( 'Interval ( ms )', 'habakiri' ),
			'default' => self::get_default( 'slider_option_interval' ),
			'section' => 'habakiri_slider_option',
		) );

		$this->Customizer_Framework->number( 'slider_option_speed', array(
			'label'   => __( 'Effect Speed ( ms )', 'habakiri' ),
			'default' => self::get_default( 'slider_option_speed' ),
			'section' => 'habakiri_slider_option',
		) );

		$this->Customizer_Framework->color( 'slider_option_overlay_color', array(
			'label'   => __( 'Overlay color', 'habakiri' ),
			'default' => self::get_default( 'slider_option_overlay_color' ),
			'section' => 'habakiri_slider_option',
		) );

		$this->Customizer_Framework->range( 'slider_option_overlay_opacity', array(
			'label'   => __( 'Overlay opacity', 'habakiri' ),
			'default' => self::get_default( 'slider_option_overlay_opacity' ),
			'section' => 'habakiri_slider_option',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		) );

		$this->Customizer_Framework->number( 'slider_option_height', array(
			'label'       => __( 'Height ( px )', 'habakiri' ),
			'default'     => self::get_default( 'slider_option_height' ),
			'section'     => 'habakiri_slider_option',
			'description' => __( 'If 0, height is auto.', 'habakiri' ),
		) );

		for ( $i = 1; $i <= 5; $i ++ ) {
			$section_id = 'habakiri_slider_image_' . $i;
			$this->Customizer_Framework->add_section( $section_id, array(
				'title' =>  sprintf( __( 'Image (%d)', 'habakiri' ), $i ),
				'panel' => 'habakiri_slider',
			) );
			$this->Customizer_Framework->image( 'slider_image_' . $i, array(
				'label'   => __( 'Image', 'habakiri' ),
				'section' => $section_id,
			) );
			$this->Customizer_Framework->textarea( 'slider_content_' . $i, array(
				'label'   => __( 'Content', 'habakiri' ),
				'section' => $section_id,
			) );
			$this->Customizer_Framework->url( 'slider_url_' . $i, array(
				'label'   => __( 'URL', 'habakiri' ),
				'section' => $section_id,
			) );
			$this->Customizer_Framework->checkbox( 'slider_target_' . $i, array(
				'label'   => __( 'Open link in new window', 'habakiri' ),
				'default' => self::get_default( 'slider_target_' . $i ),
				'section' => $section_id,
			) );
		}
	}

	/**
	 * Convert the color code to the RGB
	 *
	 * @param string $hex
	 */
	protected function hex_to_rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		return array( $r, $g, $b );
	}

	/**
	 * Register styles
	 */
	public function register_styles() {
		$rgb_header_bg_color = $this->hex_to_rgb( Habakiri::get( 'header_bg_color' ) );

		$this->Customizer_Framework->register_styles(
			'a',
			sprintf( 'color: %s', Habakiri::get( 'link_color' ) )
		);

		$this->Customizer_Framework->register_styles(
			array(
				'a:focus',
				'a:active',
				'a:hover',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'link_hover_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.site-branding a',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'logo_text_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav a',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'gnav_link_color' ) ),
				sprintf( 'font-size: %spx', Habakiri::get( 'gnav_fontsize' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav a small',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'gnav_sub_label_color' ) ),
				sprintf( 'font-size: %spx', Habakiri::get( 'gnav_sub_label_fontsize' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav a:hover small',
				'.responsive-nav a:active small',
				'.responsive-nav .current-menu-item small',
				'.responsive-nav .current-menu-ancestor small',
				'.responsive-nav .current-menu-parent small',
				'.responsive-nav .current_page_item small',
				'.responsive-nav .current_page_parent small',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'gnav_sub_label_hover_color' ) ),
			)
		);

		$gnav_link_bg_color = Habakiri::get( 'gnav_link_bg_color' );
		if ( $this->hex_to_rgb( $gnav_link_bg_color ) == $rgb_header_bg_color ) {
			$gnav_link_bg_color = 'transparent';
		}
		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav .menu>.menu-item>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a',
			),
			array(
				sprintf( 'background-color: %s', $gnav_link_bg_color ),
				sprintf( 'padding: %dpx %dpx', Habakiri::get( 'gnav_link_vertical_padding' ), Habakiri::get( 'gnav_link_horizontal_padding' ) ),
			)
		);

		$gnav_link_bg_hover_color = Habakiri::get( 'gnav_link_bg_hover_color' );
		if ( $this->hex_to_rgb( $gnav_link_bg_hover_color ) == $rgb_header_bg_color ) {
			$gnav_link_bg_hover_color = 'transparent';
		}
		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav .menu>.menu-item>a:hover',
				'.responsive-nav .menu>.menu-item>a:active',
				'.responsive-nav .menu>.current-menu-item>a',
				'.responsive-nav .menu>.current-menu-ancestor>a',
				'.responsive-nav .menu>.current-menu-parent>a',
				'.responsive-nav .menu>.current_page_item>a',
				'.responsive-nav .menu>.current_page_parent>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a:hover',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a:active',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-item>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-ancestor>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-parent>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current_page_item>a',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current_page_parent>a',
			),
			array(
				sprintf( 'background-color: %s', $gnav_link_bg_hover_color ),
				sprintf( 'color: %s', Habakiri::get( 'gnav_link_hover_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav .sub-menu a',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'gnav_pulldown_bg_color' ) ),
				sprintf( 'color: %s', Habakiri::get( 'gnav_pulldown_link_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav .sub-menu a:hover',
				'.responsive-nav .sub-menu a:active',
				'.responsive-nav .sub-menu .current-menu-item a',
				'.responsive-nav .sub-menu .current-menu-ancestor a',
				'.responsive-nav .sub-menu .current-menu-parent a',
				'.responsive-nav .sub-menu .current_page_item a',
				'.responsive-nav .sub-menu .current_page_parent a',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'gnav_pulldown_bg_hover_color' ) ),
				sprintf( 'color: %s', Habakiri::get( 'gnav_pulldown_link_hover_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.off-canvas-nav',
			),
			array(
				sprintf( 'font-size: %spx', Habakiri::get( 'offcanvas_nav_fontsize' ) ),
			)
		);

		$gnav_bg_color = Habakiri::get( 'gnav_bg_color' );
		if ( $this->hex_to_rgb( $gnav_bg_color ) == $rgb_header_bg_color ) {
			$gnav_bg_color = 'transparent';
		}
		$this->Customizer_Framework->register_styles(
			array(
				'.responsive-nav',
				'.header--transparency.header--fixed--is_scrolled .responsive-nav',
			),
			array(
				sprintf( 'background-color: %s', $gnav_bg_color ),
			)
		);

		$hamburger_btn_bg_color           = Habakiri::get( 'hamburger_btn_bg_color' );
		$hamburger_btn_border_color       = Habakiri::get( 'hamburger_btn_border_color' );
		$hamburger_btn_bg_hover_color     = Habakiri::get( 'hamburger_btn_bg_hover_color' );
		$hamburger_btn_border_hover_color = Habakiri::get( 'hamburger_btn_border_hover_color' );
		if ( $this->hex_to_rgb( $hamburger_btn_bg_color ) == $rgb_header_bg_color ) {
			$hamburger_btn_bg_color = 'transparent';
		}
		if ( $this->hex_to_rgb( $hamburger_btn_border_color ) == $rgb_header_bg_color ) {
			$hamburger_btn_border_color = 'transparent';
		}
		if ( $this->hex_to_rgb( $hamburger_btn_bg_hover_color ) == $rgb_header_bg_color ) {
			$hamburger_btn_bg_hover_color = 'transparent';
		}
		if ( $this->hex_to_rgb( $hamburger_btn_border_hover_color ) == $rgb_header_bg_color ) {
			$hamburger_btn_border_hover_color = 'transparent';
		}
		$this->Customizer_Framework->register_styles(
			array(
				'#responsive-btn',
			),
			array(
				sprintf( 'background-color: %s', $hamburger_btn_bg_color ),
				sprintf( 'border-color: %s', $hamburger_btn_border_color ),
				sprintf( 'color: %s', Habakiri::get( 'hamburger_btn_text_color' ) ),
			)
		);
		$this->Customizer_Framework->register_styles(
			array(
				'#responsive-btn:hover',
			),
			array(
				sprintf( 'background-color: %s', $hamburger_btn_bg_hover_color ),
				sprintf( 'border-color: %s', $hamburger_btn_border_hover_color ),
				sprintf( 'color: %s', Habakiri::get( 'hamburger_btn_text_hover_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.habakiri-slider__transparent-layer',
			),
			array(
				sprintf(
					'background-color: rgba( %s, %s )',
					implode( ',', $this->hex_to_rgb( Habakiri::get( 'slider_option_overlay_color' ) ) ),
					1 - Habakiri::get( 'slider_option_overlay_opacity' ) / 100
				),
			)
		);

		if ( Habakiri::get( 'slider_option_height' ) ) {
			$this->Customizer_Framework->register_styles(
				array(
					'.habakiri-slider',
					'.habakiri-slider__item',
				),
				array(
					sprintf( 'height: %spx', Habakiri::get( 'slider_option_height' ) ),
					'overflow: hidden',
				)
			);
		}

		$this->Customizer_Framework->register_styles(
			array(
				'.page-header',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'page_header_bg_color' ) ),
				sprintf( 'color: %s', Habakiri::get( 'page_header_text_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.pagination>li>a',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'link_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.pagination>li>span',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'link_color' ) ),
				sprintf( 'border-color: %s', Habakiri::get( 'link_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.pagination>li>a:focus',
				'.pagination>li>a:hover',
				'.pagination>li>span:focus',
				'.pagination>li>span:hover',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'link_hover_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.header',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'header_bg_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.header--transparency.header--fixed--is_scrolled',
			),
			array(
				sprintf( 'background-color: %s !important', Habakiri::get( 'header_bg_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.footer',
			),
			array(
				sprintf( 'background-color: %s', Habakiri::get( 'footer_bg_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.footer-widget-area a',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'footer_link_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.footer-widget-area',
				'.footer-widget-area .widget_calendar #wp-calendar caption',
			),
			array(
				sprintf( 'color: %s', Habakiri::get( 'footer_text_color' ) ),
			)
		);

		$this->Customizer_Framework->register_styles(
			array(
				'.footer-widget-area .widget_calendar #wp-calendar',
				'.footer-widget-area .widget_calendar #wp-calendar *',
			),
			array(
				sprintf( 'border-color: %s', Habakiri::get( 'footer_text_color' ) ),
			)
		);

		if ( $gnav_breakpoint = Habakiri::get_gnav_breakpoint() ) {
			$this->Customizer_Framework->register_styles(
				array(
					'.responsive-nav',
				),
				array(
					'display: block',
				),
				'',
				$gnav_breakpoint
			);

			$this->Customizer_Framework->register_styles(
				array(
					'.off-canvas-nav',
					'#responsive-btn',
				),
				array(
					'display: none !important',
				),
				'',
				$gnav_breakpoint
			);

			$this->Customizer_Framework->register_styles(
				array(
					'.header--2row',
				),
				array(
					'padding-bottom: 0',
				),
				'',
				$gnav_breakpoint
			);

			$this->Customizer_Framework->register_styles(
				array(
					'.header--2row .header__col',
					'.header--center .header__col',
				),
				array(
					'display: block',
				),
				'',
				$gnav_breakpoint
			);

			$this->Customizer_Framework->register_styles(
				array(
					'.header--2row .responsive-nav',
					'.header--center .responsive-nav',
				),
				array(
					'margin-right: -1000px',
					'margin-left: -1000px',
					'padding-right: 1000px',
					'padding-left: 1000px',
				),
				'',
				$gnav_breakpoint
			);

			if ( $gnav_bg_color == 'transparent' && $gnav_link_bg_color == 'transparent' && $gnav_link_bg_hover_color == 'transparent' ) {
				$this->Customizer_Framework->register_styles(
					array(
						'.header--2row .site-branding',
						'.header--center .site-branding',
					),
					array(
						'padding-bottom: 0',
					),
					'',
					$gnav_breakpoint
				);
			}

			$this->Customizer_Framework->register_styles(
				array(
					'.header--center .site-branding',
				),
				array(
					'text-align: center',
				),
				'',
				$gnav_breakpoint
			);
		}
	}
}
