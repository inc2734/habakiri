/**
 * jquery.responsive-nav
 * Description: レスポンシブなナビゲーションを実装。プルダウンナビ <=> オフキャンバスナビ
 * Version: 1.1.3
 * Author: Takashi Kitajima
 * Autho URI: http://2inc.org
 * created : February 20, 2014
 * modified: February 5, 2015
 * package: jquery
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
;( function( $ ) {
	$.fn.responsive_nav = function( config ) {
		var is_open     = false;
		var container   = $( '#responsive-nav-wrapper' );
		var responsive_nav = this;
		var offcanvas_nav;

		return this.each( function( i, e ) {
			offcanvas_nav = responsive_nav.clone( true );
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
				if ( is_open ) {
					nav_close();
				}
			} );

			$( '#responsive-btn' ).click( function() {
				if ( is_open ) {
					nav_close();
				} else {
					nav_open();
				}
			} );
			$( 'html' ).click( function() {
				if ( is_open ) {
					nav_close();
				}
			} );
		} );

		function init() {
			if ( $( '#responsive-btn' ).css( 'display' ) !== 'none' ) {
				wrap_all();
			} else {
				unwrap();
				unset_off_canvas_nav();
			}
		}

		function get_slide_width() {
			return offcanvas_nav.width();
		}

		function nav_open() {
			var height = get_window_height();
			offcanvas_nav.css( {
				height: height
			} );
			offcanvas_nav.show();
			container.css( 'width', container.width() );
			container.animate( {
				marginLeft: get_slide_width()
			}, 200, function() {
				is_open = true;
				$( 'body' ).addClass( 'nav-open' );
			} );
		}

		function nav_close() {
			container.animate( {
				marginLeft: 0
			}, 200, function() {
				unwrap();
				wrap_all();
			} );
		}

		function unwrap() {
			is_open = false;
			container.css( {
				'width'     : '',
				'marginLeft': ''
			} );
			$( 'body' ).removeClass( 'nav-open' );
			responsive_nav.show();
			offcanvas_nav.remove();
		}

		function wrap_all() {
			container.prepend( offcanvas_nav );
			responsive_nav.hide();
			offcanvas_nav.addClass( 'off-canvas-nav' );
			offcanvas_nav.css( 'left', - get_slide_width() );
		}

		function get_window_height() {
			var height      = $( window ).height();
			var html_margin = parseInt( $( 'html' ).css( 'marginTop' ) );
			height = height - html_margin;
			return height;
		}

		function unset_off_canvas_nav() {
			offcanvas_nav.removeClass( 'off-canvas-nav' );
			offcanvas_nav.css( 'display', 'block' );
		}
	}
} )( jQuery );