(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
/**
 * jquery.responsive-nav
 * Description: レスポンシブなナビゲーションを実装。プルダウンナビ <=> オフキャンバスナビ。要 Genericons
 * Version    : 2.3.0
 * Author     : inc2734
 * Autho URI  : http://2inc.org
 * created    : February 20, 2014
 * modified   : October 9, 2015
 * package    : jquery
 * License    : GPLv2 or later
 * License URI: license.txt
 */
;( function( $ ) {
	$.fn.responsive_nav = function( config ) {
		var config = $.extend( {
			container: $( 'body' ),
			contents : $( '#container' ),
			direction: 'right',
			theme    : 'off-canvas-nav--dark'
		}, config );

		var resize_timer   = false;
		var container      = config.container;
		var contents       = config.contents;
		var responsive_nav = this;
		
		container.addClass( 'responsive-nav-wrapper' );
		if ( config.direction === 'left' ) {
			container.addClass( 'off-canvas-nav-left' );
		} else {
			container.addClass( 'off-canvas-nav-right' );
		}
		contents.addClass( 'responsive-nav-contents' );
		
		if ( $( '.off-canvas-nav' ).length < 1 ) {
			var offcanvas_nav = responsive_nav.clone( true );
			offcanvas_nav.addClass( config.theme );
		} else {
			var offcanvas_nav = $( '.off-canvas-nav' );
		}
		
		offcanvas_nav.addClass( 'off-canvas-nav' );
		offcanvas_nav.removeClass( 'nav--hide' );

		container.prepend( offcanvas_nav );
		responsive_nav.addClass( 'responsive-nav' );
		responsive_nav.removeClass( 'nav--hide' );

		return responsive_nav.each( function( i, e ) {
			init();

			var menu = $( this ).find( 'ul' );
			menu.children( 'li' ).hover( function() {
				var children = $( this ).children( 'ul' );
				if ( children.length ) {
					if ( $( window ).width() < ( children.width() + children.offset().left ) ) {
						children.addClass( 'reverse-pulldown' );
						children.find( 'ul' ).addClass( 'reverse-pulldown' );
					}
				}
			} );

			$( window ).resize( function() {
				if ( offcanvas_nav.css( 'display' ) == 'none' ) {
					nav_close();
					if ( resize_timer !== false ) {
						clearTimeout( resize_timer );
					}
					resize_timer = setTimeout( function() {
						var children = menu.find( 'ul' );
						children.removeClass( 'reverse-pulldown' );
						init();
					}, 300 );
				}
			} );

			$( '#responsive-btn' ).on( 'click', function( e ) {
				if ( !container.hasClass( 'off-canvas-nav-open' ) ) {
					nav_open();
				} else {
					nav_close();
				}
				e.stopPropagation();
			} );
			
			offcanvas_nav.on( 'click', function( e ) {
				e.stopPropagation();
			} );

			contents.on( 'click', function( e ) {
				nav_close();
			} );
		} );

		function init() {
			nav_close();
		}

		function nav_open() {
			offcanvas_nav.css( 'visibility', 'visible' );
			container.addClass( 'off-canvas-nav-open' );

			if ( is_ios() ) {
				$( 'html' ).addClass( 'open-for-ios' );
			}
			
			contents.on( 'touchmove.noscroll', function( e ) {
				offcanvas_nav.off( '.noscroll' );
				e.preventDefault();
			} );
		}

		function nav_close() {
			container.removeClass( 'off-canvas-nav-open' );

			container.removeClass( 'open-for-ios' );
			$( 'html' ).removeClass( 'open-for-ios' );
			
			contents.off( '.noscroll' );
		}

		function is_iphone () {
			var _ret = false;
			if ( navigator.userAgent.match( /iPhone/i ) ) {
				_ret = true;
			}
			return _ret;
		}
		function is_ipad () {
			var _ret = false;
			if ( navigator.userAgent.match( /iPad/i ) ) {
				_ret = true;
			}
			return _ret;
		}
		function is_ipod () {
			var _ret = false;
			if ( navigator.userAgent.match( /iPod/i ) ) {
				_ret = true;
			}
			return _ret;
		}
		function is_ios () {
			var _ret = false;
			if ( is_iphone() || is_ipad() || is_ipod() ) {
				_ret = true;
			}
			return _ret;
		}
	}
} )( jQuery );

},{}]},{},[1]);
