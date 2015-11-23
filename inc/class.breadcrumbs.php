<?php
/**
 * Name       : Habakiri Breadcrumbs
 * Version    : 1.0.1
 * Author     : inc2734
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : July 31, 2015
 * License    : GPLv2 or later
 * License URI: license.txt
 */
class Habakiri_Breadcrumbs {

	/**
	 * Store each item of breadcrumbs in ascending order
	 * @var array
	 */
	protected $bread_crumb = array();

	/**
	 * __construct
	 */
	public function __construct() {
	}

	/**
	 * Display breadcrumbs
	 */
	public function display() {
		if ( Habakiri::get( 'is_displaying_bread_crumb' ) === 'false' ) {
			return;
		}

		global $wp_query;

		// Set to home
		$home_label = $this->get_home_label();
		$this->set( $home_label, home_url( '/' ) );

		// Set to blog
		$post_type = $this->get_post_type();
		if ( ( is_category() || is_tag() || is_date() || is_author() ) || ( is_single() && $post_type === 'post' ) ) {
			$show_on_front  = get_option( 'show_on_front' );
			$page_for_posts = get_option( 'page_for_posts' );
			if ( $show_on_front === 'page' && $page_for_posts ) {
				$this->set( get_the_title( $page_for_posts ), get_permalink( $page_for_posts ) );
			}
		}

		// Set current and ancestors
		if ( is_404() ) {
			$this->set_for_404();
		}
		elseif ( is_search() ) {
			$this->set_for_search();
		}
		elseif ( is_tax() ) {
			$this->set_for_tax();
		}
		elseif ( is_attachment() ) {
			$this->set_for_attachment();
		}
		elseif ( is_page() && !is_front_page() ) {
			$this->set_for_page();
		}
		elseif ( is_post_type_archive() ) {
			$this->set_for_post_type_archive();
		}
		elseif ( is_single() ) {
			$this->set_for_single();
		}
		elseif ( is_category() ) {
			$this->set_for_category();
		}
		elseif ( is_tag() ) {
			$this->set_for_tag();
		}
		elseif ( is_author() ) {
			$this->set_for_author();
		}
		elseif ( is_day() ) {
			$this->set_for_day();
		}
		elseif ( is_month() ) {
			$this->set_for_month();
		}
		elseif ( is_year() ) {
			$this->set_for_year();
		}
		elseif ( is_home() && !is_front_page() ) {
			$this->set_for_blog();
		}

		$bread_crumb = array();
		$last_item = array_pop( $this->bread_crumb );
		foreach ( $this->bread_crumb as $_bread_crumb ) {
			if ( !empty( $_bread_crumb['link'] ) ) {
				$bread_crumb[] = sprintf(
					'<a href="%s">%s</a>',
					esc_url( $_bread_crumb['link'] ),
					esc_html( $_bread_crumb['title'] )
				);
			} else {
				$bread_crumb[] = esc_html( $_bread_crumb['title'] );
			}
		}
		$bread_crumb[] = sprintf( '<strong>%s</strong>', $last_item['title'] );
		printf(
			'<div class="breadcrumbs">%s</div>',
			implode(
				' &gt; ',
				apply_filters( 'habakiri_bread_crumb', $bread_crumb )
			)
		);
	}

	/**
	 * Return front page label
	 *
	 * @return string
	 */
	protected function get_home_label() {
		$page_on_front = get_option( 'page_on_front' );
		$home_label    = __( 'Home', 'habakiri' );
		if ( $page_on_front ) {
			$home_label = get_the_title( $page_on_front );
		}
		return $home_label;
	}

	/**
	 * add a item
	 *
	 * @param string $title
	 * @param string $link
	 */
	protected function set( $title, $link = '' ) {
		$this->bread_crumb[] = array(
			'title' => $title,
			'link'  => $link,
		);
	}

	/**
	 * Add a item at the time of blog page display
	 */
	protected function set_for_blog() {
		$page_for_posts = get_option( 'page_for_posts' );
		if ( $page_for_posts ) {
			$title = get_the_title( $page_for_posts );
			$this->set( $title );
		}
	}

	/**
	 * Add a item at the time of 404 page display
	 */
	protected function set_for_404() {
		$this->set( __( 'Page not found', 'habakiri' ) );
	}

	/**
	 * Add a item at the time of search page display
	 */
	protected function set_for_search() {
		$this->set(
			sprintf(
				__( 'Search Results for: %s', 'habakiri' ),
				get_search_query()
			)
		);
	}

	/**
	 * Add a item at the time of taxonomy archive page display
	 */
	protected function set_for_tax() {
		$taxonomy = get_query_var( 'taxonomy' );
		$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );

		$taxonomy_objects = get_taxonomy( $taxonomy );
		$post_types = $taxonomy_objects->object_type;
		$post_type = array_shift( $post_types );
		if ( $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$label = $post_type_object->labels->singular_name;
			$this->set( $label, $this->get_post_type_archive_link( $post_type ) );
		}

		if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent ) {
			$this->set_ancestors( $term->term_id, $taxonomy );
		}
		$this->set( $term->name );
	}

	/**
	 * Add a item at the time of attachement page display
	 */
	protected function set_for_attachment() {
		$this->set( get_the_title() );
	}

	/**
	 * Add a item at the time of page display
	 */
	protected function set_for_page() {
		$this->set_ancestors( get_the_ID(), 'page' );
		$this->set( get_the_title() );
	}

	/**
	 * Add a item at the time of custom post type archive page display
	 */
	protected function set_for_post_type_archive() {
		$post_type = $this->get_post_type();
		if ( $post_type && $post_type !== 'post' ) {
			$post_type_object = get_post_type_object( $post_type );
			$label = $post_type_object->labels->singular_name;
			$this->set( $label );
		}
	}

	/**
	 * Add a item at the time of single page display
	 */
	protected function set_for_single() {
		$post_type = $this->get_post_type();
		if ( $post_type && $post_type !== 'post' ) {
			$post_type_object = get_post_type_object( $post_type );
			$label = $post_type_object->labels->singular_name;
			$this->set( $label, $this->get_post_type_archive_link( $post_type ) );

			$taxonomies = $post_type_object->taxonomies;
			if ( $taxonomies ) {
				$taxonomy = array_shift( $taxonomies );
				$terms    = get_the_terms( get_the_ID(), $taxonomy );
				if ( $terms ) {
					$term = array_shift( $terms );
					$this->set_ancestors( $term->term_id, $taxonomy );
					$this->set( $term->name, get_term_link( $term ) );
				}
			}
		}
		else {
			$categories = get_the_category( get_the_ID() );
			if ( $categories ) {
				$category = array_shift( $categories );
				$this->set_ancestors( $category->term_id, 'category' );
				$this->set( $category->name, get_term_link( $category ) );
			}
		}
		$this->set( get_the_title() );
	}

	/**
	 * Add a item at the time of category archive page display
	 */
	protected function set_for_category() {
		$category_name = single_cat_title( '', false );
		$category_id   = get_cat_ID( $category_name );
		$this->set_ancestors( $category_id, 'category' );
		$this->set( $category_name );
	}

	/**
	 * Add a item at the time of tag archive page display
	 */
	protected function set_for_tag() {
		$this->set( single_tag_title( '', false ) );
	}

	/**
	 * Add a item at the time of author page display
	 */
	protected function set_for_author() {
		$author_id = get_query_var( 'author' );
		$this->set( get_the_author_meta( 'display_name', $author_id ) );
	}

	/**
	 * Add a item at the time of day page display
	 */
	protected function set_for_day() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
			$day   = get_query_var( 'day' );
		} else {
			$m     = get_query_var( 'm' );
			$year  = substr( $m, 0, 4 );
			$month = substr( $m, 4, 2 );
			$day   = substr( $m, -2 );
		}
		$this->set( $this->year( $year ), get_year_link( $year ) );
		$this->set( $this->month( $month ), get_month_link( $year, $month ) );
		$this->set( $this->day( $day ) );
	}

	/**
	 * Add a item at the time of month page display
	 */
	protected function set_for_month() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
		} else {
			$m     = get_query_var( 'm' );
			$year  = substr( $m, 0, 4 );
			$month = substr( $m, -2 );
		}
		$this->set( $this->year( $year ), get_year_link( $year ) );
		$this->set( $this->month( $month ) );
	}

	/**
	 * Add a item at the time of year page display
	 */
	protected function set_for_year() {
		$year = get_query_var( 'year' );
		if ( !$year ) {
			$m    = get_query_var( 'm' );
			$year = $m;
		}
		$this->set( $this->year( $year ) );
	}

	/**
	 * Set the ancestors of the specified page or taxonomy
	 *
	 * @param int $object_id Post ID or Term ID
	 * @param string $object_type
	 */
	protected function set_ancestors( $object_id, $object_type ) {
		$ancestors = get_ancestors( $object_id, $object_type );
		krsort( $ancestors );
		if ( $object_type === 'page' ) {
			foreach ( $ancestors as $ancestor_id ) {
				$this->set( get_the_title( $ancestor_id ), get_permalink( $ancestor_id ) );
			}
		} else {
			foreach ( $ancestors as $ancestor_id ) {
				$ancestor = get_term( $ancestor_id, $object_type );
				$this->set( $ancestor->name, get_term_link( $ancestor ) );
			}
		}
	}

	/**
	 * Return custom post type archive page url
	 *
	 * @param string $post_type custom post type name
	 * @return null|string
	 */
	protected function get_post_type_archive_link( $post_type ) {
		$post_type_archive_link = get_post_type_archive_link( $post_type );
		if ( $post_type_archive_link ) {
			return $post_type_archive_link;
		}
	}

	/**
	 * Return year label
	 *
	 * @param string $year
	 * @return string
	 */
	protected function year( $year ) {
		if ( get_locale() === 'ja' ) {
			$year .= '年';
		}
		return $year;
	}

	/**
	 * Return month label
	 *
	 * @param string $month
	 * @return string
	 */
	protected function month( $month ) {
		if ( get_locale() === 'ja' ) {
			$month .= '月';
		} else {
			$monthes = array(
				1  => 'January',
				2  => 'February',
				3  => 'March',
				4  => 'April',
				5  => 'May',
				6  => 'June',
				7  => 'July',
				8  => 'August',
				9  => 'September',
				10 => 'October',
				11 => 'November',
				12 => 'December',
			);
			$month = $monthes[$month];
		}
		return $month;
	}

	/**
	 * Return day label
	 *
	 * @param string $day
	 * @return string
	 */
	protected function day( $day ) {
		if ( get_locale() === 'ja' ) {
			$day .= '日';
		}
		return $day;
	}

	/**
	 * Return the current post type
	 *
	 * @return string
	 */
	private function get_post_type() {
		global $wp_query;
		$post_type = get_post_type();
		if ( !$post_type ) {
			if ( isset( $wp_query->query['post_type'] ) ) {
				$post_type = $wp_query->query['post_type'];
			}
		}
		return $post_type;
	}
}
