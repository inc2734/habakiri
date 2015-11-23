<?php
/**
 * Version    : 1.0.0
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : October 24, 2015
 * Modified   :
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>

<?php
$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
$format = apply_filters( 'search_form_format', $format );
?>

<?php if ( 'html5' == $format ) : ?>
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="s"><?php echo _x( 'Search for:', 'label' ); ?></label>
		<div class="input-group">
			<input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
			<span class="input-group-btn">
				<input type="submit" class="btn btn-default" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</span>
		</div>
	</form>
<?php  else : ?>
	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="s"><?php echo _x( 'Search for:', 'label' ); ?></label>
		<div class="input-group">
			<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s" />
			<span class="input-group-btn">
				<input type="submit" class="btn btn-default" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</span>
		</div>
	</form>
<?php endif; ?>
