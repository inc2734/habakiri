/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : September 6, 2015
 * Modified   : 
 * License    : GPLv2 or later
 * License URI: license.txt
 */

var height   = 0;
var position = 'static';

jQuery( function( $ ) {
	var wpadminbar = $( '#wpadminbar' );

	if ( wpadminbar.length ) {
		height   = parseInt( wpadminbar.outerHeight() );
		position = wpadminbar.css( 'position' );
	}

	$( window ).resize( function() {
		height = parseInt( wpadminbar.outerHeight() );
		position = wpadminbar.css( 'position' );
	} );
} );

module.exports = {
	position: function() {
		return position;
	},
	
	height: function() {
		return height;
	}
};
