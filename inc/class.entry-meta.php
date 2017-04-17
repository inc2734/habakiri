<?php
/**
 * Name       : Habakiri Entry Meta
 * Version    : 1.0.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 19, 2015
 * Modified   : August 7, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Entry_Meta {
	
	/**
	 * Display Entry Meta
	 */
	public function display() {
		do_action( 'habakiri_before_entry_meta' );
		?>
		<div class="entry-meta">
			<ul class="entry-meta__list">
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
	 * Return the author
	 */
	protected function author() {
		global $post;
		return sprintf(
			'<li class="entry-meta__item vCard author">%s: <a href="%s"><span class="fn">%s</span></a></li>',
			__( 'Author', 'habakiri' ),
			esc_url( get_author_posts_url( $post->post_author ) ),
			esc_attr( get_the_author() )
		);
	}

	/**
	 * Return the public date
	 */
	protected function published() {
		return sprintf(
			'<li class="entry-meta__item published"><time datetime="%s">%s: %s</time></li>',
			esc_attr( get_the_date( 'c' ) ),
			__( 'Published', 'habakiri' ),
			esc_html( get_the_date() )
		);
	}

	/**
	 * Return the updated date
	 */
	protected function updated() {
		return sprintf(
			'<li class="entry-meta__item updated hidden"><time datetime="%s">%s: %s</time></li>',
			esc_attr( get_the_modified_date( 'c' ) ),
			__( 'Updated', 'habakiri' ),
			esc_html( get_the_modified_date() )
		);
	}

	/**
	 * Return the categories
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
				'<li class="entry-meta__item categories">%s: %s</li>',
				__( 'Category', 'habakiri' ),
				implode( ', ', $categories )
			);
		}
	}

	/**
	 * Return the tags
	 */
	protected function tags() {
		if ( $tags_list = get_the_tag_list( '', ', ' ) ) {
			return sprintf(
				'<li class="entry-meta__item tags">%s: %s</li>',
				__( 'Tags', 'habakiri' ),
				$tags_list
			);
		}
	}

	/**
	 * Return the taxonomies
	 */
	protected function taxonomies() {
		$taxonomies = Habakiri::get_the_taxonomies();
		foreach ( $taxonomies as $taxonomy_name ) {
			$term_list = get_the_term_list( get_the_ID(), $taxonomy_name, '', ', ', '' );
			return sprintf(
				'<li class="entry-meta__item %s">%s: %s</li>',
				esc_attr( $taxonomy_name ),
				esc_attr( get_taxonomy( $taxonomy_name)->labels->name ),
				$term_list
			);
		}
	}
}
