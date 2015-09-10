<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : August 30, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */

$Slider = new Habakiri_Slider();
$items  = $Slider->get_saved_items();
if ( $items ) {
	foreach ( $items as $item ) {
		$Slider->set_item( $item );
	}
} else {
	$default_slider_items = array(
		array(
			'image'   => get_template_directory_uri() . '/images/slider/1.jpg',
			'content' => sprintf(
				'<div class="text-center">
					<h1>%s</h1>
					<p class="lead">%s</p>
					<a class="btn btn-default" href="http://habakiri.2inc.org" target="_blank">READ MORE</a>
				</div>',
				esc_html( 'Habakiri', 'habakiri' ),
				esc_html__( 'Habakiri is a simple theme based on Bootstrap3. This theme\'s goal is to create a responsive, bootstrap based WordPress theme quickly.', 'habakiri' )
			),
		),
		array(
			'image'   => get_template_directory_uri() . '/images/slider/2.jpg',
			'content' => sprintf(
				'<div class="text-center">
					<h1>%s</h1>
					<p class="lead">%s%s</p>
					<a class="btn btn-default" href="%s">Customizer</a>
				</div>',
				esc_html__( 'Habakiri have slider feature !', 'habakiri' ),
				esc_html__( 'This is sample slider. You can setting slider in Customizer.', 'habakiri' ),
				esc_html__( 'The set sliders are displayed in Rich Front Page template.', 'habakiri' ),
				admin_url( 'customizer.php' )
			),
		),
		array(
			'image' => get_template_directory_uri() . '/images/slider/3.jpg',
		),
	);
	$default_slider_items = apply_filters( 'habakiri_default_slider_items', $default_slider_items );
	foreach ( $default_slider_items as $default_slider_item ) {
		$Slider->set_item( $default_slider_item );
	}
}
$Slider->display();
