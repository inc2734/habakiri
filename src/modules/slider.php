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

require_once get_template_directory() . '/inc/class.slider.php';

$Slider = new Habakiri_Slider();
$items  = $Slider->get_saved_items();
if ( $items ) {
	foreach ( $items as $item ) {
		$Slider->set_item( $item );
	}
} else {
	$Slider->set_item( array(
		'image'   => get_template_directory_uri() . '/images/slider/1.jpg',
		'content' => sprintf(
			'<div class="text-center">
				<h1>Habakiri</h1>
				<p class="lead">%s</p>
				<a class="btn btn-default" href="http://habakiri.2inc.org" target="_blank">READ MORE</a>
			</div>',
			esc_html__( 'Habakiri is a simple theme based on Bootstrap3. This theme\'s goal is to create a responsive, bootstrap based WordPress theme quickly.', 'habakiri' )
		),
	) );
	$Slider->set_item( array(
		'image'   => get_template_directory_uri() . '/images/slider/2.jpg',
		'content' => sprintf(
			'<div class="text-center">
				<h1>You can setting slider !</h1>
				<p class="lead">%s<br />%s</p>
				<a class="btn btn-default" href="%s">Customizer</a>
			</div>',
			esc_html__( 'This is sample slider. You can setting slider in Customizer.', 'habakiri' ),
			esc_html__( 'The set sliders are displayed in Rich Front Page template.', 'habakiri' ),
			admin_url( 'customizer.php' )
		),
	) );
	$Slider->set_item( array(
		'image' => get_template_directory_uri() . '/images/slider/3.jpg',
	) );
}
$Slider->display();
