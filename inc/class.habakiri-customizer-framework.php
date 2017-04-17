<?php
/**
 * Name       : Habakiri_Customizer
 * Description: This is a Customizer API Framework. Setting::type is only theme_mod.
 * Version    : 1.0,0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 18, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Habakiri_Customizer_Framework {

	/**
	 * @var WP_Customizer
	 */
	protected $Customizer;

	/**
	 * @var array
	 */
	protected $styles = array();

	/**
	 * @var array
	 */
	protected $choices = array();

	/**
	 * @var array
	 */
	protected $defaults = array();

	public function __construct() {
		add_action( 'wp_head', array( $this, 'wp_head' ), 12 );
	}

	/**
	 * You must register WP_Customizer when field registerd.
	 *
	 * @param WP_Customize_Manager $Customizer
	 */
	public function register_customizer( WP_Customize_Manager $Customizer ) {
		$this->Customizer = $Customizer;
	}

	/**
	 * Get a theme setting default value.
	 *
	 * @param string $id theme setting id
	 * @return string|null
	 */
	protected function get_default( $id ) {
		if ( isset( $this->defaults[$id] ) ) {
			return $this->defaults[$id];
		}
	}

	/**
	 * Register CSS with Customizer.
	 * This method called wp_head action hook and priority 10 or less.
	 *
	 * @param string|array $selectors
	 * @param string|array $properties
	 * @param int $max_width
	 * @param int $min_width
	 */
	public function register_styles( $selectors, $properties, $max_width = '', $min_width = '' ) {
		if ( is_array( $selectors ) ) {
			$selectors = implode( ',', $selectors );
		}
		$selectors = $this->remove_white_spaces( $selectors );
		$selectors = preg_replace( '/,+/', ',', $selectors );

		if ( is_array( $properties ) ) {
			$properties = implode( ';', $properties );
		}
		$properties = $this->remove_white_spaces( $properties );
		$properties = preg_replace( '/;+/', ';', $properties );

		if ( $max_width && !$min_width ) {
			$key = $max_width . ',';
		} elseif ( !$max_width && $min_width ) {
			$key = ',' . $min_width;
		} elseif ( $max_width && $min_width ) {
			$key = $max_width . ',' . $min_width;
		} else {
			$key = ',';
		}
		$this->styles[$key][] = array( $selectors => $properties );
	}

	/**
	 * Print expand $this->styles
	 */
	public function wp_head() {
		$output = '';
		foreach ( $this->styles as $media_query => $styles ) {
			$media_queries = explode( ',', $media_query );
			if ( $media_queries[0] !== '' && $media_queries[1] === '' ) {
				$media_query_wrapper = '@media(max-width:' . esc_html( $media_queries[0] ) . 'px){%s}';
			}
			elseif ( $media_queries[0] === '' && $media_queries[1] !== '' ) {
				$media_query_wrapper = '@media(min-width:' . esc_html( $media_queries[1] ) . 'px){%s}';
			}
			elseif ( $media_queries[0] !== '' && $media_queries[1] !== '' ) {
				$media_query_wrapper = '@media(max-width:' . esc_html( $media_queries[0] ) . 'px)and(min-width:' . esc_html( $media_queries[1] ) . 'px){%s}';
			}
			else {
				$media_query_wrapper = '%s';
			}

			$_styles = '';
			foreach ( $styles as $style ) {
				foreach ( $style as $selectors => $properties ) {
					$_styles .= sprintf(
						'%s{%s}',
						$selectors,
						esc_html( $properties )
					);
				}
			}
			$output .= sprintf( $media_query_wrapper, $_styles );
		}
		if ( $output ) {
			printf( '<style>%s</style>', $output );
		}
	}

	/**
	 * Remove spaces, tabs, line-breaks
	 *
	 * @param string $value
	 * @return string
	 */
	protected function remove_white_spaces( $value ) {
		$value = preg_replace( '/\n|\r|\r\n|\t/', '', $value );
		$value = preg_replace( '/ +/', ' ', $value );
		$value = preg_replace( '/(:) */', '$1', $value );
		$value = preg_replace( '/(;) */', '$1', $value );
		return $value;
	}

	/**
	 * Method that wrapped WP_Customize_Manager::add_panel()
	 *
	 * @param string $panel_id
	 * @param array $args
	 */
	public function add_panel( $panel_id, $args = array() ) {
		$this->Customizer->add_panel( $panel_id, $args );
	}

	/**
	 * Method that wrapped WP_Customize_Manager::add_section()
	 *
	 * @param string $section_id
	 * @param array $args
	 */
	public function add_section( $section_id, $args = array() ) {
		$this->Customizer->add_section( $section_id, $args );
	}

	/**
	 * Method that wrapped WP_Customize_Manager::add_section()
	 *
	 * @param string $section_id
	 */
	public function remove_section( $section_id ) {
		$this->Customizer->remove_section( $section_id );
	}

	/**
	 * Text field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function text( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'sanitize_text_field' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'text',
				) )
			)
		);
	}

	/**
	 * Checkbox
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function checkbox( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, array( $this, 'sanitize_checkbox' ) );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'checkbox',
				) )
			)
		);
	}

	/**
	 * Radio button
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function radio( $control_id, $args ) {
		if ( empty( $args['choices'] ) ) {
			return;
		}
		$this->set_choices( $control_id, $args['choices'] );

		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, array( $this, 'sanitize_choices_' . $control_id ) );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'radio',
				) )
			)
		);
	}

	/**
	 * Select box
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function select( $control_id, $args ) {
		if ( empty( $args['choices'] ) ) {
			return;
		}
		$this->set_choices( $control_id, $args['choices'] );

		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, array( $this, 'sanitize_choices_' . $control_id ) );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'select',
				) )
			)
		);
	}

	/**
	 * Dropdown pages
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function dropdown_pages( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'dropdown-pages',
				) )
			)
		);
	}

	/**
	 * Textarea
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function textarea( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'textarea',
				) )
			)
		);
	}

	/**
	 * Email field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function email( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'sanitize_email' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'email',
				) )
			)
		);
	}

	/**
	 * URL field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function url( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'esc_url_raw' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'url',
				) )
			)
		);
	}

	/**
	 * Number field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function number( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, array( $this, 'sanitize_number_' . $control_id ) );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'number',
				) )
			)
		);
	}

	/**
	 * Range field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function range( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, array( $this, 'sanitize_number_' . $control_id ) );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
					'type'     => 'range',
				) )
			)
		);
	}

	/**
	 * Image field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function image( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'esc_url_raw' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Image_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
				) )
			)
		);
	}

	/**
	 * File field
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function file( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'esc_url_raw' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Upload_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
				) )
			)
		);
	}

	/**
	 * Color picker
	 *
	 * @param string $control_id
	 * @param array $args argments of add_setting and add_control
	 */
	public function color( $control_id, $args ) {
		$args = $this->init_field_args( $control_id, $args );
		$args = $this->set_default_sanitize_callback( $args, 'sanitize_hex_color' );
		$this->Customizer->add_setting( $control_id, $args );
		$this->Customizer->add_control(
			new WP_Customize_Color_Control(
				$this->Customizer,
				$control_id,
				array_merge( $args, array(
					'settings' => $control_id,
				) )
			)
		);
	}

	/**
	 * Initialize field argments
	 *
	 * @param string $control_id
	 * @param array $args
	 * @return array
	 */
	protected function init_field_args( $control_id, $args ) {
		if ( !empty( $args['default'] ) ) {
			$this->set_defaults( $control_id, $args['default'] );
		} else {
			$this->set_defaults( $control_id, '' );
		}
		unset( $args['type'] );

		return $args;
	}

	/**
	 * Set default sanitize callback function
	 *
	 * @param array $args
	 * @param string $callback_name
	 * @return array
	 */
	protected function set_default_sanitize_callback( $args, $callback_name ) {
		if ( empty( $args['sanitize_callback'] ) ) {
			$args['sanitize_callback'] = $callback_name;
		}
		return $args;
	}

	/**
	 * Set choices property
	 *
	 * @param string $control_id
	 * @param array $choices
	 */
	protected function set_choices( $control_id, $choices ) {
		$this->choices[$control_id] = $choices;
	}

	/**
	 * Set default theme settings
	 *
	 * @param string $control_id
	 * @param array $default
	 */
	protected function set_defaults( $control_id, $default ) {
		$this->defaults[$control_id] = $default;
	}

	/**
	 * Sanitize method for checkbox
	 *
	 * @param string $value
	 * @return bool
	 */
	public function sanitize_checkbox( $value ) {
		if ( $value == true || $value === 'true' ) {
			return true;
		}
		return false;
	}

	/**
	 * Sanitize method for number
	 *
	 * @param string control_id
	 * @param string $value
	 * @return string
	 */
	protected function _sanitize_number( $control_id, $value ) {
		if ( preg_match( '/^\d+$/', $value ) ) {
			return $value;
		}
		return $this->get_default( $control_id );
	}

	/**
	 * Sanitize method for choices ( radio, select )
	 *
	 * @param string control_id
	 * @param string $value
	 * @return string
	 */
	protected function _sanitize_choices( $control_id, $value ) {
		if ( !empty( $this->choices[$control_id] )
			 && is_array( $this->choices[$control_id] )
			 && isset( $this->choices[$control_id][$value] ) ) {
			return $value;
		}
		return $this->get_default( $control_id );
	}

	/**
	 * @param string $method
	 * @param array $args
	 * @return string
	 */
	public function __call( $method, $args ) {
		if ( preg_match( '/^sanitize_choices_(.+)$/', $method, $reg ) ) {
			if ( !empty( $reg[1] ) ) {
				$id = $reg[1];
				return $this->_sanitize_choices( $id, $args[0] );
			}
		}
		elseif ( preg_match( '/^sanitize_number_(.+)$/', $method, $reg ) ) {
			if ( !empty( $reg[1] ) ) {
				$id = $reg[1];
				return $this->_sanitize_number( $id, $args[0] );
			}
		}
	}
}
