<?php
/**
 * Version    : 1.2.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : August 28, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<main id="main" role="main">

				<?php Habakiri::the_bread_crumb(); ?>
				<?php
				$name = ( is_search() ) ? 'search' : 'archive';
				if ( have_posts() ) {
					get_template_part( 'content', $name );
				} else {
					get_template_part( 'content', 'none' );
				}
				?>

			<!-- end #main --></main>
		<!-- end .col-md-10 --></div>
	<!-- end .row --></div>
<!-- end .container --></div>
