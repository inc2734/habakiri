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
var adminbar  = require( './adminbar.js' );
var getScroll = require( './scroll.js' );

jQuery( function( $ ) {
	
	/**
	 * content top padding tuning with fixed and no transparency header
	 */
	( function() {
		var header  = $( '.header--fixed' );
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
	} )();
	
	/**
	 * fixed header class setting
	 */
	( function() {
		var header  = $( '.header--fixed' );
		if ( header.length ) {
			$( window ).scroll( function() {
				if ( getScroll() > 0 ) {
					header.addClass( 'header--fixed--is_scrolled' );
				} else {
					header.removeClass( 'header--fixed--is_scrolled' );
				}
			} );
		}
	} )();

	/**
	 * offcanvas nav position tuning
	 */
	( function() {
		var button = $( '#responsive-btn' );

		/**
		 * adminbar exist
		 */
		if ( adminbar.height() ) {
			button.click( function( e ) {
				var offcanvas_nav = $( '.off-canvas-nav' );
				var default_style = offcanvas_nav.attr( 'style' );
				var offcanvas_nav_top = '0 !important';
				var scroll = getScroll();
				var adminbar_height = adminbar.height();
				if ( adminbar.position() === 'fixed' || scroll == 0 ) {
					offcanvas_nav_top = adminbar_height + 'px !important';
				} else if ( adminbar.position() === 'absolute' && adminbar_height > scroll ) {
					offcanvas_nav_top = adminbar_height - scroll + 'px !important';
				}
				offcanvas_nav.css( {
					'cssText': default_style + 'top: ' + offcanvas_nav_top
				} );
				e.stopPropagation();
			} );
		}
		
		/**
		 * header - fixed
		 */
		var header = $( '.header--fixed' );
		if ( header.length ) {
			$( window ).scroll( function() {
				if ( adminbar.position() === 'absolute' && getScroll() < adminbar.height() ) {
					header.css( 'position', 'absolute' );
				} else {
					header.css( 'position', '' );
				}
			} );
			
			$( document ).click( function() {
				header.css( 'top', '' );
			} );
			
			button.click( function( e ) {
				var wrapper = $( '.responsive-nav-wrapper' );
				var header_top = '';
				var scroll = getScroll();
				var adminbar_height = adminbar.height();
				if ( wrapper.hasClass( 'open' ) ) {
					if ( adminbar.position() == 'absolute' ) {
						if ( scroll >= adminbar_height ) {
							header_top = scroll - adminbar_height;
						}
					} else {
						header_top = scroll;
					}
				}
				header.css( 'top', header_top );
				e.stopPropagation();
			} );
		}
	} )();
} );
