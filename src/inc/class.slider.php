<?php
/**
 * Name       : Habakiri Slider
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 15, 2015
 * Modified   : 
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Slider {

	/**
	 * Max count of slider items
	 * @var int
	 */
	protected $max = 5;

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
	}

	/**
	 * Fire bxslider
	 */
	public function wp_footer() {
		?>
		<script>
		jQuery( function( $ ) {
			$( '.habakiri-slider__list' ).slick( {
				arrows: true,
				adaptiveHeight: true,
				autoplay: <?php echo esc_js( ( Habakiri::get( 'slider_option_interval' ) ) ? 'true' : 'false' ); ?>,
				autoplaySpeed: <?php echo esc_js( Habakiri::get( 'slider_option_interval' ) ); ?>,
				speed: <?php echo esc_js( Habakiri::get( 'slider_option_speed' ) ); ?>,
				fade: <?php echo esc_js( ( Habakiri::get( 'slider_option_effect' ) === 'fade' ) ? 'true' : 'false' ); ?>,
				nextArrow: '<span class="habakiri-slider__arrow habakiri-slider__arrow--next genericon genericon-collapse"></span>',
				prevArrow: '<span class="habakiri-slider__arrow habakiri-slider__arrow--prev genericon genericon-collapse"></span>'
			} );
		} );
		</script>
		<?php
	}

	/**
	 * Get slider items in theme customizer.
	 *
	 * @return array
	 */
	protected function get_items() {
		$slider = array();
		for ( $i = 1; $i <= $this->max; $i ++ ) {
			if ( !Habakiri::get( 'slider_image_' . $i ) ) {
				continue;
			}
			$slider[] = array(
				'image'   => Habakiri::get( 'slider_image_' . $i ),
				'content' => Habakiri::get( 'slider_content_' . $i ),
				'url'     => Habakiri::get( 'slider_url_' . $i ),
				'target'  => Habakiri::get( 'slider_target_' . $i ),
			);
		}
		return $slider;
	}

	/**
	 * Display slider
	 */
	public function display() {
		$items = $this->get_items();
		if ( !$items ) {
			return;
		}
		?>
		<div class="habakiri-slider">
			<div class="habakiri-slider__list bxslider">
				<?php
				foreach ( $items as $slide ) {
					$item = sprintf(
						'<div class="habakiri-slider__item-wrapper col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
							<div class="habakiri-slider__item-content col-xs-12">
								%s
							</div>
						</div>
						<img src="%s" alt="" class="habakiri-slider__image" />',
						$slide['content'],
						esc_url( $slide['image'] )
					);
					if ( $slide['url'] ) {
						$item = sprintf(
							'<a class="habakiri-slider__link" href="%s" target="%s">%s</a>',
							esc_url( $slide['url'] ),
							esc_attr( ( $slide['target'] ) ? '_blank' : '_self' ),
							$item
						);
					}
					printf(
						'<section class="habakiri-slider__item" style="background-image: url( %s );">
							<div class="habakiri-slider__transparent-layer">
								%s
							</div>
						</section>',
						esc_url( $slide['image'] ),
						$item
					);
				}
				?>
			</div>
		</div>
		<?php
	}
}
