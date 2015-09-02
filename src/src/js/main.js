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
require( './slick/slick.js' );

jQuery( function( $ ) {

	/**
	 * .global-nav
	 */
	$( '.js-responsive-nav' ).responsive_nav();

	/**
	 * #header
	 */
	( function() {
		var header = $( '.header--fixed' );
		if ( header.length && !header.hasClass( 'header--transparency' ) ) {
			function set_padding_form_fixed_header() {
				var height = header.outerHeight();
				$( '#contents' ).css( 'marginTop', height );
			}
			set_padding_form_fixed_header();
			$( window ).resize( function() {
				set_padding_form_fixed_header();
			} );
		}

		if ( header.length ) {
			$( window ).scroll( function() {
				if ( $( document ).scrollTop() > 0 ) {
					header.addClass( 'header--fixed--is_scrolled' );
				} else {
					header.removeClass( 'header--fixed--is_scrolled' );
				}
			} );

			$( '#responsive-btn' ).click( function() {
				var wrapper = $( '.responsive-nav-wrapper' );
				var scroll  = 0;
				$( 'html, body' ).each( function() {
					var _scroll = $( this ).scrollTop();
					if ( _scroll > scroll ) {
						scroll = _scroll
					}
				} );
				if ( wrapper.hasClass( 'open' ) ) {
					header.css( 'top', parseInt( scroll ) );
				} else {
					header.css( 'top', '' );
				}
			} );
		}
	} )();
} );
