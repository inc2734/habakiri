<?php
/**
 * Name       : Habakiri Related Posts
 * Version    : 1.0.3
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 19, 2015
 * Modified   : August 8, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Related_Posts {

	/**
	 * 関連記事を表示
	 */
	public function display() {
		if ( Habakiri::get( 'is_displaying_related_posts' ) === 'false' ) {
			return;
		}

		$post_type = get_post_type();
		$tax_query = $this->get_tax_query( $post_type );

		if ( $tax_query ) {
			$posts = $this->get_related_posts( $tax_query );
		}

		if ( empty( $posts ) ) {
			return;
		}

		global $post, $wp_query;
		$default_query         = clone $wp_query;
		$wp_query->is_single   = false;
		$wp_query->is_page     = false;
		$wp_query->is_singular = false;
		?>
		<div class="related-posts">
			<h2 class="related-posts__title h3"><?php _e( 'Related posts', 'habakiri' ); ?></h2>
			<div class="entries entries--related-posts entries-related-posts">
				<?php
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					get_template_part( 'content' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
		$wp_query = $default_query;
	}

	/**
	 * tax_query に渡す条件の配列を返す
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
		);
		return $condition;
	}

	/**
	 * 指定された投稿タイプ用の tax_query を返す
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
	 * 関連記事を取得
	 *
	 * @param array $tax_query
	 * @return array
	 */
	protected function get_related_posts( $tax_query ) {
		global $post;
		if ( !$post ) {
			return array();
		}
		$args = array(
			'post_type'      => get_post_type( $post->ID ),
			'posts_per_page' => apply_filters( 'habakiri_relates_posts_per_page', 3 ),
			'orderby'        => 'rand',
			'post__not_in'   => array( $post->ID ),
			'tax_query'      => array_merge(
				array(
					'relation' => 'AND',
				),
				$tax_query
			),
		);

		$args  = apply_filters( 'habakiri_relates_posts_args', $args );
		$posts = get_posts( $args );
		return $posts;
	}

	/**
	 * カテゴリーの ID を取得
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
	 * タグの ID を取得
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
	 * カスタムタクソノミーのターム ID を取得
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
