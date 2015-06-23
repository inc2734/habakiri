/**
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
require( '../../assets/bootstrap/javascripts/bootstrap.js' );
require( './jquery.responsive-nav/jquery.responsive-nav.js' );

jQuery( function( $ ) {
	
	/**
	 * .global-nav
	 */
	$( '.global-nav' ).responsive_nav();

	/**
	 * #header
	 */
	function set_padding_form_fixed_header() {
		var header = $( '.header-fixed' );
		var height = header.outerHeight();
		$( '#contents' ).css( 'marginTop', height );
	}
	set_padding_form_fixed_header();
	$( window ).resize( function() {
		set_padding_form_fixed_header();
	} );
} );