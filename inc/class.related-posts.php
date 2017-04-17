<?php
/**
 * Name       : Habakiri Related Posts
 * Version    : 1.2.2
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 19, 2015
 * Modified   : December 9, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Related_Posts {

	/**
	 * Display related posts
	 */
	public function display() {
		$posts = $this->get_related_posts();

		if ( empty( $posts ) ) {
			return;
		}

		global $post, $wp_query;
		$default_query = clone $wp_query;
		set_query_var( 'is_related', true );
		?>
		<div class="related-posts">
			<h2 class="related-posts__title h3"><?php _e( 'Related posts', 'habakiri' ); ?></h2>
			<div class="entries entries--related-posts entries-related-posts">
				<?php
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					get_template_part( 'content', 'summary' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
		$wp_query = $default_query;
	}

	/**
	 * Return the argments for the tax_query
	 *
	 * @param string $taxonomy_name
	 * @param array $term_ids
	 * @return array
	 */
	protected function get_tax_query_condition( $taxonomy_name, $term_ids ) {
		$condition = array(
			'taxonomy' => $taxonomy_name,
			'field'    => 'id',
			'terms'    => $term_ids,
			'operator' => 'AND',
		);
		return $condition;
	}

	/**
	 * Return the tax_query for the specified post type
	 *
	 * @param string $post_type
	 * @return array
	 */
	protected function get_tax_query( $post_type ) {
		$tax_query = array();

		if ( $post_type === 'post' ) {
			$category_ids = $this->get_the_category_ids();
			if ( $category_ids ) {
				$tax_query[] = $this->get_tax_query_condition( 'category', $category_ids );
			}
			$tag_ids = $this->get_the_tag_ids();
			if ( $tag_ids ) {
				$tax_query[] = $this->get_tax_query_condition( 'post_tag', $tag_ids );
			}
			return $tax_query;
		}

		if ( $post_type ) {
			$taxonomies = Habakiri::get_the_taxonomies();
			foreach ( $taxonomies as $taxonomy_name ) {
				$term_ids = $this->get_the_term_ids( $taxonomy_name );
				if ( $term_ids ) {
					$tax_query[] = $this->get_tax_query_condition( $taxonomy_name, $term_ids );
				}
			}
			return $tax_query;
		}
		return $tax_query;
	}

	/**
	 * Return the related posts
	 *
	 * @return array
	 */
	public function get_related_posts() {
		global $post;
		if ( !$post ) {
			return array();
		}
		
		$post_type = get_post_type();
		$tax_query = $this->get_tax_query( $post_type );
		if ( !$tax_query ) {
			return array();
		}

		$args = array(
			'post_type'      => get_post_type( $post->ID ),
			'posts_per_page' => apply_filters( 'habakiri_relates_posts_per_page', 3 ),
			'orderby'        => 'rand',
			'post__not_in'   => array( $post->ID ),
			'tax_query'      => array_merge(
				array(
					'relation' => 'OR',
				),
				$tax_query
			),
		);

		$args  = apply_filters( 'habakiri_relates_posts_args', $args );
		$posts = get_posts( $args );
		return $posts;
	}

	/**
	 * Return the category ids
	 *
	 * @return array
	 */
	protected function get_the_category_ids() {
		$category_ids = array();
		$categories = get_the_category();
		if ( is_array( $categories ) ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}
		return $category_ids;
	}

	/**
	 * Return the tag ids
	 *
	 * @return array
	 */
	protected function get_the_tag_ids() {
		$tag_ids = array();
		$tags = get_the_tags();
		if ( is_array( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}
		return $tag_ids;
	}

	/**
	 * Return the custom taxonomy ids
	 *
	 * @param string $taxonomy_name
	 * @return array
	 */
	protected function get_the_term_ids( $taxonomy_name ) {
		$term_ids = array();
		$terms = get_the_terms( get_the_ID(), $taxonomy_name );
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_ids[] = $term->term_id;
			}
		}
		return $term_ids;
	}
}
