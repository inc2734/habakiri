<?php
/**
 * Version    : 1.2.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 17, 2015
 * Modified   : October 25, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="commentarea" class="commentarea">
	<?php if ( !empty( $comments_by_type['comment'] ) || comments_open() ) : ?>
	<div id="comments" class="comments">
		<h2 class="comments__title h3"><?php _e( 'Comments on this post', 'habakiri' ); ?></h2>
		<?php if ( !empty( $comments_by_type['comment'] ) ) : ?>
		<ol class="comments__list">
			<?php
			wp_list_comments( array(
				'type'     => 'comment',
				'callback' => 'Habakiri::the_comments'
			) );
			?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="pager">
			<p>
				<?php
				paginate_comments_links( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			</p>
		<!-- end .pager --></div>
		<?php endif; ?>

		<?php else : ?>
		<p class="comments__nocomments"><?php _e( 'No comments.', 'habakiri' ); ?></p>
		<?php endif; ?>

		<?php if ( comments_open() ) : ?>
		<div id="respond" class="comments__respond">
			<?php if ( get_option( 'comment_registration' ) && !$user_ID ) : ?>
			<p>
				<?php
				printf(
					__( 'It is necessary to <a href="%/wp-login.php?redirect_to=%s">login</a> to write comment.', 'habakiri' ),
					home_url(),
					get_permalink()
				);
				?>
			</p>
			<?php else : ?>
			<div id="comment-form" class="comments__form">
				<?php
				comment_form();
				?>
			<!-- end #comment-form --></div>
			<?php endif; ?>
		<!-- end #respond --></div>
		<?php endif; ?>
	<!-- end #comments --></div>
	<?php endif; ?>

	<?php if ( !empty( $comments_by_type['pings'] ) || pings_open() ) : ?>
	<div id="trackback" class="trackbacks">
		<h2 class="trackbacks__title h3"><?php _e( 'Trackbacks and Pingbacks on this post', 'habakiri' ); ?></h2>
		<?php if ( !empty( $comments_by_type['pings'] ) ) : ?>
		<ol class="trackbacks__list">
			<?php
			wp_list_comments( array(
				'type'     => 'pings',
				'callback' => 'Habakiri::the_pings'
			) );
			?>
		</ol>
		<?php else : ?>
		<p class="trackbacks__notrackbacks"><?php _e( 'No trackbacks.', 'habakiri' ); ?></p>
		<?php endif; ?>

		<?php if ( pings_open() ) : ?>
		<div class="trackbacks__trackback-url">
			<dl>
				<dt><?php _e( 'TrackBack URL', 'habakiri' ); ?></dt>
				<dd><input id="tburl" class="form-control" type="text" size="50" value="<?php trackback_url( true ); ?>" readonly="readonly" /></dd>
			</dl>
		<!-- end .trackbacks__trackback-url --></div>
		<?php endif; ?>
	<!-- end #trackback --></div>
	<?php endif; ?>
<!-- end #commentarea --></div>
