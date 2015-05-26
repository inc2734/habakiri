/**
 * jquery.responsive-nav
 * Description: レスポンシブなナビゲーションを実装。プルダウンナビ <=> オフキャンバスナビ。要 Genericons
 * Version    : 2.0.0
 * Author     : Takashi Kitajima
 * Autho URI  : http://2inc.org
 * created    : February 20, 2014
 * modified   : May 26, 2015
 * package    : jquery
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
;( function( $ ) {
	$.fn.responsive_nav = function( config ) {
		var config = $.extend( {
			container: $( 'body' ),
			contents : $( '#container' )
		}, config );

		var container      = config.container;
		var contents       = config.contents;
		var responsive_nav = this;
		var offcanvas_nav  = responsive_nav.clone( true );

		return this.each( function( i, e ) {
			container.addClass( 'responsive-nav-wrapper' );
			contents.addClass( 'responsive-nav-contents' );
			offcanvas_nav.addClass( 'off-canvas-nav' );

			container.prepend( offcanvas_nav );
			responsive_nav.addClass( 'responsive-nav' );

			init();

			var menu = $( this ).find( 'ul:first-child' );
			menu.children( 'li' ).children( 'ul' ).children( 'li' ).hover( function() {
				var children = $( this ).children( 'ul' );
				if ( children.length ) {
					if ( $( window ).width() < ( children.width() + children.offset().left ) ) {
						children.addClass( 'reverse-pulldown' );
						children.find( 'ul' ).addClass( 'reverse-pulldown' );
					}
				}
			} );

			$( window ).resize( function() {
				var children = menu.children( 'li' ).children( 'ul' ).children( 'li' );
				children.removeClass( 'reverse-pulldown' );
				children.find( 'ul' ).removeClass( 'reverse-pulldown' );
				init();
			} );

			$( '#responsive-btn' ).on( 'click touchend', function() {
				if ( container.hasClass( 'open' ) ) {
					nav_close();
				} else {
					nav_open();
				}
			} );

			$( document ).on( 'click touchend', function( e ) {
				var contain_btn = $( '#responsive-btn' ).get( 0 );
				var contain_nav = offcanvas_nav.get( 0 );
				var contained   = e.target;
				if ( contain_btn != contained && !$.contains( contain_nav, contained ) && contain_nav != contained ) {
					if ( container.hasClass( 'open' ) ) {
						nav_close();
					}
				}
			} );
		} );

		function init() {
			offcanvas_nav.css( 'right', - get_slide_width() );
			nav_close();
		}

		function get_slide_width() {
			return offcanvas_nav.width();
		}

		function nav_open() {
			var height = get_window_height();
			var width  = get_slide_width();
			container.addClass( 'open' );
		}

		function nav_close() {
			container.removeClass( 'open' );
			container.css( 'height', '' );
		}

		function get_window_height() {
			var height      = $( window ).height();
			var html_margin = parseInt( $( 'html' ).css( 'marginTop' ) );
			height = height - html_margin;
			return height;
		}
	}
} )( jQuery );