<?php
/**
 * Name       : Habakiri Entry Meta
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 19, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class Habakiri_Entry_Meta {
	
	/**
	 * Entry Meta を表示
	 */
	public function display() {
		do_action( 'habakiri_before_entry_meta' );
		?>
		<div class="entry-meta">
			<ul>
				<?php
				$entry_meta  = $this->published();
				$entry_meta .= $this->updated();
				$entry_meta .= $this->author();
				$entry_meta .= $this->categories();
				$entry_meta .= $this->tags();
				$entry_meta .= $this->taxonomies();
				echo apply_filters( 'habakiri_entry_meta', $entry_meta );
				?>
			</ul>
		<!-- end .entry-meta --></div>
		<?php
		do_action( 'habakiri_after_entry_meta' );
	}

	/**
	 * 著者を取得
	 */
	protected function author() {
		global $post;
		return sprintf(
			'<li class="vCard author">%s: <a href="%s"><span class="fn">%s</span></a></li>',
			__( 'Author', 'habakiri' ),
			esc_url( get_author_posts_url( $post->post_author ) ),
			esc_attr( get_the_author() )
		);
	}

	/**
	 * 公開日を取得
	 */
	protected function published() {
		return sprintf(
			'<li class="published"><time datetime="%s">%s: %s</time></li>',
			esc_attr( get_the_date( 'c' ) ),
			__( 'Published', 'habakiri' ),
			esc_html( get_the_date() )
		);
	}

	/**
	 * 更新日を取得
	 */
	protected function updated() {
		return sprintf(
			'<li class="updated hidden"><time datetime="%s">%s: %s</time></li>',
			esc_attr( get_the_modified_date( 'c' ) ),
			__( 'Updated', 'habakiri' ),
			esc_html( get_the_modified_date() )
		);
	}

	/**
	 * カテゴリーを取得
	 */
	protected function categories() {
		$categories = array();
		if ( $_categories = get_the_category() ) {
			foreach ( $_categories as $category ) {
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $category->cat_ID ),
					esc_html( $category->cat_name )
				);
			}
			return sprintf(
				'<li class="categories">%s: %s</li>',
				__( 'Category', 'habakiri' ),
				implode( ', ', $categories )
			);
		}
	}

	/**
	 * タグを取得
	 */
	protected function tags() {
		if ( $tags_list = get_the_tag_list( '', ', ' ) ) {
			return sprintf(
				'<li class="tags">%s: %s</li>',
				__( 'Tags', 'habakiri' ),
				$tags_list
			);
		}
	}

	/**
	 * タクソノミーを取得
	 */
	protected function taxonomies() {
		$taxonomies = Habakiri::get_the_taxonomies();
		$taxonomy = '';
		foreach ( $taxonomies as $taxonomy_name ) {
			$term_list = get_the_term_list( get_the_ID(), $taxonomy_name, '', ', ', '' );
			$taxonomy = sprintf(
				'<li class="%s">%s: %s</li>',
				esc_attr( $taxonomy_name ),
				esc_attr( get_taxonomy( $taxonomy_name)->labels->name ),
				$term_list
			);
		}
	}
}
