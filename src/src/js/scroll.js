/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : September 6, 2015
 * Modified   : 
 * License    : GPLv2 or later
 * License URI: license.txt
 */

var scroll = 0;

jQuery( function( $ ) {
	$( window ).scroll( function() {
		scroll = ( function() {
			var pre_scroll = 0;
			$( 'html, body' ).each( function() {
				var _scroll = $( this ).scrollTop();
				if ( _scroll >= pre_scroll ) {
					pre_scroll = parseInt( _scroll );
				}
			} );
			return pre_scroll;
		} )();
	} );
} );

module.exports = function() {
	return scroll;
}
