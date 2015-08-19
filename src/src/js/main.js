/**
 * Version    : 1.1.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 15, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
require( '../../assets/bootstrap/javascripts/bootstrap.js' );
require( './jquery.responsive-nav/jquery.responsive-nav.js' );
require( './jquery.bxslider/jquery.bxslider.js' );

jQuery( function( $ ) {
	
	/**
	 * .global-nav
	 */
	$( '.global-nav' ).responsive_nav();

	/**
	 * #header
	 */
	if ( $( '.header--transparency' ).length == 0 ) {
		function set_padding_form_fixed_header() {
			var header = $( '.header--fixed' );
			var height = header.outerHeight();
			$( '#contents' ).css( 'marginTop', height );
		}
		set_padding_form_fixed_header();
		$( window ).resize( function() {
			set_padding_form_fixed_header();
		} );
	}

	if ( $( '.header--transparency' ).length ) {
		$( window ).scroll( function() {
			var header = $( '.header--transparency' );
			if ( header.hasClass( '.header--fixed' ) ) {
				if ( $( document ).scrollTop() > 0 ) {
					header.addClass( 'header--transparency--is_scrolled' );
				} else {
					header.removeClass( 'header--transparency--is_scrolled' );
				}
			}
		} );
	}
} );
